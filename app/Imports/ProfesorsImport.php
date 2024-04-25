<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Profesor;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProfesorsImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {    
        // Crear un nuevo usuario 
        $user = new User();
        $user->name = $row[0] . ' ' . $row[1]; 
        $user->email = $row[4]; 
        $user->password = bcrypt($row[2]);
        $user->save();
        // Crear un nuevo tutor asociado al usuario 
        $profesor = new Profesor();
        $profesor->nombre = $row[0]; 
        $profesor->apellido = $row[1];
        $profesor->ci = $row[2];  
        $profesor->celular = $row[3];
        $profesor->direccion = $row[5];
        $profesor->user_id = $user->id;
        $profesor->save();

        $user->assignRole('profesor');
        return $user;
    }
              
}    