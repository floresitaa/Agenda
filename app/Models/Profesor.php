<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Profesor extends Model
{
    use HasFactory;
    use HasRoles; 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'nombre',
        'apellido',
        'ci',
        'celular',
        'direccion',
    ];
    public $timestamps = false;
    
    public function materiacurso()
    {
        return $this->hasMany(materiacurso::class, 'prosefor_id');
    }
}
