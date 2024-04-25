<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarea extends Model
{
    protected $fillable = [
        'id',
        'fecha_publicacion',
        'fecha_entrega',
        'descripcion',
        'estado',
        'archivo_url',
        'materiacurso_id',
    ]; // Campos que se pueden asignar
    public $timestamps = false;
    
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    public function materia()
    {
        return $this->belongsTo(materia::class, 'materia_id');
    }

    public function curso()
    {
        return $this->belongsTo(curso::class, 'curso_id');
    }

    public function materiacurso()
    {
        return $this->belongsTo(materiacurso::class,'id');
    }
    use HasFactory;
}
