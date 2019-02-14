<?php
/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 28/12/18
 * Time: 11:45
 */

namespace App\Models;


use App\Http\Traits\LogSave;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    use LogSave;

    static $permisos = ['update', 'create', 'view', 'delete'];
    static $noRestablecer = true;

    public $table = 'media';
    public $fillable = ['ruta'];

}