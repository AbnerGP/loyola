<?php

namespace App\Models;

use App\Http\Traits\LogSave;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\MetableTrait as Metable;

class Libro extends Model
{
    use Metable, LogSave;
    static $permisos = ['update', 'create', 'view', 'delete'];
    static $noRestablecer = true;

    protected $dates = ['deleted_at'];

    protected $allRelations = [
        'meta',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'ubicacion',
        'keywords',
        'autor',
        'num_edicion',
        'lugar_edicion',
        'coleccion',
        'editorial',
        'num_libro',
        'year',
        'tema',
    ];
}
