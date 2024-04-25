<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Validate unique email before creating the user
        $existingUser = User::where('email', $row[1])->first();
        if ($existingUser) {
            throw new \Exception('El correo electrónico ya está en uso.');
        }
    
        $user = new User([
            'name' => $row[0],
            'email' => $row[1],
            'password' => bcrypt($row[2]),
        ]);
    
        // $user->assignRole('tutor'); // Assign role if needed
    
        return $user;
    }
}    
