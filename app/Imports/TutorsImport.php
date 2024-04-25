<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Tutor;
use Maatwebsite\Excel\Concerns\ToModel;
use Spatie\Permission\Models\Role;

class TutorsImport implements ToModel
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
        $tutor = new Tutor();
        $tutor->ci = $row[2]; 
        $tutor->nombre = $row[0]; 
        $tutor->apellido = $row[1]; 
        $tutor->telefono = $row[3];
        $tutor->direccion = $row[5];
        $tutor->user_id = $user->id;
        $tutor->save();
        $user->assignRole('tutor');
        //Asigna el rol al usuario  
        return $user;

    }
              
}    
