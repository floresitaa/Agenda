<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'ci',
        'rude',
        'direccion',
        'user_id',
        'curso_id',
        'tutor1_ci',
        'tutor2_ci',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relación con el primer tutor
    public function tutor1()
    {
        return $this->belongsTo(Tutor::class, 'tutor1_ci', 'ci');
    }
    // Relación con el segundo tutor
    public function tutor2()
    {
        return $this->belongsTo(Tutor::class, 'tutor2_ci', 'ci');
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public $timestamps = false;
}
