<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    //Relacion de 1 a 1 con los usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $primaryKey = 'ci';
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'direccion',
    ];

    public $timestamps = false;
}
