<?php

namespace App\Http\Controllers;

use app\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usuarios.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');
    
            // Validate file presence and extension (optional)
            $this->validate($request, [
                'file' => 'required|mimes:xlsx,xlsm,xls'
            ]);
    
            Excel::import(new UsersImport, $file);
    
            return back()->with('status', 'Usuarios importados con éxito');
    
        } catch (\Exception $e) {
            // Handle import errors
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}
