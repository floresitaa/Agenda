<?php

namespace App\Http\Controllers;

use App\Models\materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('materia.index',['materias'=>materia::all()]); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materia.create');////
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|max:40',
        ]);

        $materia=new materia();
        $materia->nombre=$request->input('nombre');;
        $materia->save();
        return view("materia.message",['msg'=>"Materia guardado con Exito"]); //
    }

    /**
     * Display the specified resource.
     */
    public function show(materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $materia = materia::findOrFail($id);
        return view('materia.edit', compact('materia'));//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $materia)
    {
        $request->validate([
            'nombre'=>'required|max:40',
        ]);
        $materia = materia::find($materia);
        $materia->nombre = $request->input('nombre');
        $materia->save();
        return view("materia.message", ['msg' => "Materia actualizado con éxito"]);  //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $materia = materia::find($id);
            $materia->delete();
        return redirect()->route('materia.index');//
    }
}
