<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Imports\TutorsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tutores.index', ['tutores' => Tutor::all()], ['users' => User::all()]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tutores.create');
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
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:50',
        ]);

        // Crea un nuevo usuario
        $user = new User();
        $user->name = $request->nombre . ' ' . $request->apellido;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Crea un nuevo tutor asociado al usuario
        $tutor = new Tutor();
        $tutor->ci = $request->ci;
        $tutor->nombre = $request->nombre;
        $tutor->apellido = $request->apellido;
        $tutor->telefono = $request->telefono;
        $tutor->direccion = $request->direccion;
        $tutor->user_id = $user->id;
        $tutor->save();
        $user->assignRole('tutor');
        // Redirecciona a alguna vista o acción después de guardar
        return redirect()->route('tutores.index')->with('success', 'Tutor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutor $tutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tutor $tutor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tutor $tutor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutor $tutor)
    {
        //
    }
    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');
            
            // Importar el archivo Excel utilizando la clase TutorsImport
            Excel::import(new TutorsImport, $file);
            
            // Si no se produce ninguna excepción, redireccionar con un mensaje de éxito
            return back()->with('status', 'Usuarios importados con éxito');
        } catch (\Exception $e) {
            // Manejar la excepción aquí
            // Por ejemplo, podrías registrarla o enviar un correo electrónico de notificación
            Log::error('Error al importar usuarios desde Excel: ' . $e->getMessage());
            
            // Redireccionar de nuevo con un mensaje de error
            return back()->with('error', 'Ocurrió un error al importar usuarios. Por favor, inténtalo de nuevo.');
        }
    }
    
}
