<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'codigo',
        'paralelo',
        'nivel',
    ];
    public $timestamps = false;

    public function materiacurso()
    {
        return $this->hasMany(materiacurso::class, 'curso_id');
    }
      // public function alumnos()
    //{
         //  return $this->hasMany(alumno::class, 'alumno_id');
    //}
}
