<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiacurso extends Model
{
    use HasFactory; // Nombre de la tabla
    protected $fillable = [
        'id',
        'curso_id', 
        'materia_id', 
        'profesor_id',
    ]; // Campos que se pueden asignar
    public $timestamps = false;
    
    public function curso()
    {
        return $this->belongsTo(curso::class, 'curso_id');
    }

    public function materia()
    {
        return $this->belongsTo(materia::class, 'materia_id');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

}
