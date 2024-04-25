<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiaprofesor extends Model
{
    use HasFactory; // Nombre de la tabla
    protected $fillable = [
        'id',
        'curso_id', 
        'materia_id', 
    ]; // Campos que se pueden asignar
    public $timestamps = false;
    
    public function profesor()
    {
        return $this->belongsTo(profesor::class, 'profesor_id');
    }

    public function materia()
    {
        return $this->belongsTo(materia::class, 'materia_id');
    }
}
