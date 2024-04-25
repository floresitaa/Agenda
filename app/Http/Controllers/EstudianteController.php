<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\curso;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Imports\EstudiantesImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('estudiantes.index', ['estudiantes' => Estudiante::all()], ['users' => User::all()], ['cursos' => curso::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');
            
            // Importar el archivo Excel utilizando la clase EstudiantesImport
            Excel::import(new EstudiantesImport, $file);
            
            // Si no se produce ninguna excepción, redireccionar con un mensaje de éxito
            return back()->with('status', 'Estudiantes importados con éxito');
        } catch (\Exception $e) {
            // Manejar la excepción aquí
            // Por ejemplo, podrías registrarla o enviar un correo electrónico de notificación
            Log::error('Error al importar estudiantes desde Excel: ' . $e->getMessage());
            
            // Redireccionar de nuevo con un mensaje de error
            return back()->with('error', 'Ocurrió un error al importar estudiantes. Por favor, inténtalo de nuevo.');
        }
    }
}
