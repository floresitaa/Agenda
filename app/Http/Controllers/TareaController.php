<?php

namespace App\Http\Controllers;

use App\Models\tarea;
use App\Models\Tutor;
use App\Models\Profesor;
use App\Models\Estudiante;
use App\Models\materiacurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ComunicadoRequest;
use Illuminate\Support\Facades\Redirect;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Obtener el ID del usuario autenticado
            $user_id = auth()->user()->id;
    
            // Verificar si el usuario es un profesor, un alumno o un tutor
            $profesor = Profesor::where('user_id', $user_id)->first();
            $alumno = Estudiante::where('user_id', $user_id)->first();
            $tutor = Tutor::where('user_id', $user_id)->first();
    
            if ($profesor) {
                // Si el usuario es un profesor
    
                // Obtener los cursos asignados al profesor actual
                $cursos = materiacurso::where('profesor_id', $profesor->id)->pluck('id');
    
                // Obtener todas las materias asignadas al profesor actual
                $materias = materiacurso::whereIn('materiacursos.curso_id', $cursos)
                    ->join('materias', 'materiacursos.materia_id', '=', 'materias.id')
                    ->pluck('materias.id');
    
                // Obtener las tareas asignadas al profesor actual paginadas
                $tareas = tarea::whereIn('materiacurso_id', $cursos)->paginate();
            } elseif ($alumno) {
                // Si el usuario es un alumno
    
                // Obtener el curso del alumno actual
                $curso_id = $alumno->curso_id;
                // Obtener las tareas asignadas al curso del alumno actual paginadas
                $curso = materiacurso::where('curso_id', $alumno->curso_id)->pluck('curso_id');
    
                $tareas = tarea::whereIn('materiacurso_id', function ($query) use ($curso_id) {
                    $query->select('id')
                        ->from('materiacursos')
                        ->where('curso_id', $curso_id);
                })->paginate();
            } elseif ($tutor) {
                // Si el usuario es un tutor
    
                // Obtener el alumno asociado al tutor
                $alumno = Estudiante::where('tutor1_ci', $tutor->ci)
                    ->orWhere('tutor2_ci', $tutor->ci)
                    ->first();
    
                // Obtener el curso del alumno asociado al tutor
                $curso_id = $alumno->curso_id;
    
                // Obtener las tareas asignadas al curso del alumno asociado al tutor
                $tareas = tarea::whereHas('materiacurso', function ($query) use ($curso_id) {
                    $query->where('curso_id', $curso_id);
                })->paginate();
            } else {
                // Si el usuario no es ni profesor, ni alumno ni tutor
    
                // Obtener todas las tareas
                $tareas = tarea::paginate();
            }
    
            // Devolver la vista con las tareas
            return view('tarea.index', compact('tareas'))
                ->with('i', ($request->input('page', 1) - 1) * $tareas->perPage());
        } catch (\Exception $e) {
            // Manejar la excepción
            Log::error('Error al importar estudiantes desde Excel: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error. Por favor, inténtalo de nuevo.');
        }
    }
    




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->user()->id;

        $profesor = Profesor::where('user_id', $user_id)->first();
        $materias = materiacurso::where('profesor_id', $profesor->id)->get();
        return view('tarea.create', compact('materias'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_publicacion' => 'required|date',
            'fecha_entrega' => 'required|date|after:fecha_inicio',
            'descripcion' => 'required',
            'estado' => 'required|max:255',
        ]);

        //obtener nombre de la imagen
        $nombreArchivo = time() . '_' . $request->archivo_url->getClientOriginalName();
        //obtener ruta
        $ruta = $request->archivo_url->storeAs('public/archivos/tareas', $nombreArchivo);
        $url = Storage::url($ruta);

        $tarea = new tarea();
        $tarea->fecha_publicacion = $request->input('fecha_publicacion');
        $tarea->fecha_entrega = $request->input('fecha_entrega');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado');
        $tarea->archivo_url = $url;
        $tarea->materiacurso_id = $request->input('materiacurso_id');
        $tarea->save();
        return view("tarea.message", ['msg' => "Tarea guardada con Exito"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tarea = tarea::find($id);
        return view('tarea.show', compact('tarea')); //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarea = tarea::find($id);
        $materias = materiacurso::all();
        return view('tarea.edit', compact('tarea', 'materias'));  //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tarea $tarea)
    {
        $request->validate([
            'fecha_publicacion' => 'required|date',
            'fecha_entrega' => 'required|date|after:fecha_inicio',
            'descripcion' => 'required',
            'estado' => 'required|max:255',
        ]);

        if ($request->hasFile('archivo_url')) {
            //obtener nombre de la imagen
            $nombreArchivo = time() . '_' . $request->archivo_url->getClientOriginalName();
            //obtener ruta
            $ruta = $request->archivo_url->storeAs('public/archivos/tareas', $nombreArchivo);
            $url = Storage::url($ruta);
        }
        $tarea->fecha_publicacion = $request->input('fecha_publicacion');
        $tarea->fecha_entrega = $request->input('fecha_entrega');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado');
        $tarea->archivo_url = $url;
        $tarea->save();
        return view("tarea.message", ['msg' => "Tarea actualizada con Exito"]); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $tarea = tarea::findOrFail($id);
        $ruta = $tarea->archivo_url;

        // Eliminar el archivo
        Storage::delete("public/archivos/tareas/{$ruta}");

        // Eliminar el registro del comunicado
        $tarea->delete();

        return redirect()->route('tarea.index')
            ->with('success', 'Tarea borrado con éxito');
    }

    public function download($id)
    {
        $tarea = tarea::findOrFail($id);
        $ruta = $tarea->archivo_url;

        $nombreArchivo = basename($ruta);

        return Storage::download("public/archivos/tareas/{$nombreArchivo}", $nombreArchivo);
    }
}
