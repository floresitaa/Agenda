<?php

namespace App\Imports;

use App\Models\User;
use App\Models\curso;
use App\Models\Tutor;
use App\Models\Estudiante;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class EstudiantesImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $user = new User();
        $user->name = $row[0] . ' ' . $row[1]; 
        $user->email = $row[4]; 
        $user->password = bcrypt($row[2]);
        $user->save();
        // Crear un nuevo tutor asociado al usuario 
        $estudiante = new Estudiante();
        $estudiante->ci = $row[2]; 
        $estudiante->nombre = $row[0]; 
        $estudiante->apellido = $row[1]; 
        $estudiante->rude = $row[3];
        $estudiante->direccion = $row[5];
        $estudiante->user_id = $user->id;
        $curso = Curso::where('codigo', $row[6])->where('paralelo', $row[7])->first();
        if ($curso) {
            $estudiante->curso_id = $curso->id;
        }
		$estudiante->tutor1_ci = $row[8];
		$estudiante->tutor2_ci = $row[9];
        $estudiante->save();  
        //Asigna el rol al usuario 
        $user->assignRole('alumno');
        return $user;
    }
}
