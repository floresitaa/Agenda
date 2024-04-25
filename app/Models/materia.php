<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
    ];
    public $timestamps = false;

    public function materiacurso()
    {
        return $this->hasMany(materiacurso::class, 'materia_id');
    }
    public function materiaprofesor()
    
    {
        return $this->hasMany(materiaprofesor::class, 'materia_id');
    }
}
