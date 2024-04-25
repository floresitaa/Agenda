<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Comunicado;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ComunicadoRequest;
use Illuminate\Support\Facades\Redirect;


class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $comunicados = Comunicado::paginate();

        return view('comunicado.index', compact('comunicados'))
            ->with('i', ($request->input('page', 1) - 1) * $comunicados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('comunicado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'required',
        ]);

        //obtener nombre de la imagen
        $nombreArchivo = time() . '_' . $request->archivo_url->getClientOriginalName();
        //obtener ruta
        $ruta = $request->archivo_url->storeAs('public/archivos/comunicados', $nombreArchivo);
        $url = Storage::url($ruta);
            $comunicado = new Comunicado();
            $comunicado->nombre = $request->input('nombre');
            $comunicado->descripcion = $request->input('descripcion');
            $comunicado->archivo_url = $url;
            $comunicado->save();
        return view("comunicado.message", ['msg' => "Guardado con Exito"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $comunicado = Comunicado::find($id);

        return view('comunicado.show', compact('comunicado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $comunicado = Comunicado::find($id);

        return view('comunicado.edit', compact('comunicado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comunicado $comunicado)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'required',
        ]);

        if ($request->hasFile('archivo_url')) {
        //obtener nombre de la imagen
        $nombreArchivo = time() . '_' . $request->archivo_url->getClientOriginalName();
        //obtener ruta
        $ruta = $request->archivo_url->storeAs('public/archivos/comunicados', $nombreArchivo);
        $url = Storage::url($ruta);
        }
        $comunicado->nombre = $request->input('nombre');
        $comunicado->descripcion = $request->input('descripcion');
        $comunicado->archivo_url = $url;
        $comunicado->save();
        return view("comunicado.message", ['msg' => "actualizado con Exito"]);
    }

    public function destroy($id): RedirectResponse
    {
        $comunicado = Comunicado::findOrFail($id);
        $ruta = $comunicado->archivo_url;
    
        // Eliminar el archivo
        Storage::delete("public/archivos/comunicados/{$ruta}");
    
        // Eliminar el registro del comunicado
        $comunicado->delete();
    
        return redirect()->route('comunicados.index')
            ->with('success', 'Comunicado borrado con éxito');
    }

    public function download($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        $ruta = $comunicado->archivo_url;
    
        $nombreArchivo = basename($ruta);
    
        return Storage::download("public/archivos/comunicados/{$nombreArchivo}", $nombreArchivo);
    }
}
