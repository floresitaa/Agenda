<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profesor;
use App\Models\materiaprofesor;
use App\Models\materia;
use Illuminate\Http\Request;
use App\Imports\ProfesorsImport;
use App\Models\materiacurso;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProfesorContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profesores.index', ['profesores' => Profesor::all()], ['users' => User::all()]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profesores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                // Valida los datos del formulario
                $request->validate([
                    'nombre' => 'required|string|max:255',
                    'apellido' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|confirmed|min:8',
                    'ci' => 'required|integer',
                    'celular' => 'required|string|max:255',
                    'direccion' => 'required|string|max:50',
                ]);
        
                // Crea un nuevo usuario
                $user = new User();
                $user->name = $request->nombre . ' ' . $request->apellido;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();
        
                // Crea un nuevo tutor asociado al usuario
                $profesor = new Profesor();
                $profesor->nombre = $request->nombre;
                $profesor->apellido = $request->apellido;
                $profesor->ci = $request->ci;
                $profesor->celular = $request->celular;
                $profesor->direccion = $request->direccion;
                $profesor->user_id = $user->id;
                $profesor->save();
                $user->assignRole('profesor');
                // Redirecciona a alguna vista o acción después de guardar
                return redirect()->route('profesores.index')->with('success', 'Profesor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        //
    }


    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        return view('profesores.edit', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $profesor)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|integer',
            'celular' => 'required|string|max:255',
            'direccion' => 'required|string|max:50',
        ]);

        $profesor = Profesor::find($profesor);
        $profesor->nombre = $request->input('nombre');
        $profesor->apellido = $request->input('apellido');
        $profesor->ci = $request->input('ci');
        $profesor->celular = $request->input('celular');
        $profesor->direccion = $request->input('direccion');
        $profesor->save();
        return view("profesores.message", ['msg' => "Profesor actualizado con éxito"]); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profesor = Profesor::find($id);
        $profesor->delete();
    return redirect()->route('profesores.index');//  //
    }
    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new ProfesorsImport, $file);

            return back()->with('status', 'Usuarios importados con éxito');
        } catch (\Exception $e) {
            Log::error('Error al importar profesores desde Excel: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al importar profesores. Por favor, inténtalo de nuevo.');
        }
    }

    public function asignar($id)
    {
        $profesores = Profesor::findOrFail($id);
        //$materias = materiacurso::all(); en caso de necesitar todos
        $materias = materiacurso::whereNull('profesor_id')->get();
        return view('profesores.asignar', compact('profesores', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function asignarmateria(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $materiacursos = $request->input('materiacurso');

        foreach ($materiacursos as $materiacursoId) {
            materiacurso::updateOrCreate(
                ['id' => $materiacursoId],
                ['profesor_id' => $profesor->id]
            );
        }
        return view("profesores.messageAsignar", ['msg' => "Materia asignada con Exito"]); //
    }

    public function eliminarMateriasAsignadas($id)
    {
    $profesor = Profesor::findOrFail($id);
    $materiasAsignadas = materiacurso::where('profesor_id', $profesor->id)->get();
    foreach ($materiasAsignadas as $materia) {
        $materia->profesor_id = null;
        $materia->save();
    }
    return redirect()->route('profesores.index')->with('success', 'Materias asignadas eliminadas con éxito');
    }
    
}
