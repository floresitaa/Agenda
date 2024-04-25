<?php

namespace App\Http\Controllers;

use App\Models\curso;
use App\Models\materia;
use App\Models\materiacurso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = curso::all();
        $materias = materia::all();
        return view('curso.index', compact('cursos', 'materias')); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = curso::all();
        $materias = materia::all();
        return view('curso.create', compact('cursos', 'materias'));
        //return view('curso.create');//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|max:10',
            'paralelo' => 'required|max:10',
            'nivel' => 'required|max:15',
        ]);

        $curso = new curso();
        $curso->codigo = $request->input('codigo');
        $curso->paralelo = $request->input('paralelo');
        $curso->nivel = $request->input('nivel');
        $curso->save();

        $materias = $request->input('materia');
        $materiacurso = new materiacurso();

        foreach ($materias as $key => $materiaId) {
            $materiacurso = new materiacurso();
            $materia = materia::find($materiaId);
            $materiacurso->materia_id = $materiaId;
            $materiacurso->curso_id = $curso->id;
            $materiacurso->save();
        }

        return view("curso.message", ['msg' => "Curso guardado con Exito"]); //
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        // Obtener todas las materias asociadas al curso
        $materiasCurso = MateriaCurso::where('curso_id', $curso->id)->with('materia')->get();
    
        // Luego, pasas estos datos a la vista para mostrarlos.
        return view('curso.show', compact('curso', 'materiasCurso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(curso $curso)
    {
        return view('curso.edit', compact('curso')); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, curso $curso)
    {
        $request->validate([
            'codigo' => 'required|max:10',
            'paralelo' => 'required|max:10',
            'nivel' => 'required|max:15',
        ]);

        $curso->codigo = $request->input('codigo');
        $curso->paralelo = $request->input('paralelo');
        $curso->nivel = $request->input('direccion');
        $curso->save();
        return view("curso.message", ['msg' => "Curso actualizado con éxito"]); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $curso = curso::find($id);
        $curso->delete();
        return redirect()->route('curso.index'); //
    }
}
