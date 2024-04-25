<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comunicado
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $archivo_url
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comunicado extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'descripcion', 'archivo_url'];
    public $timestamps = false;


}
