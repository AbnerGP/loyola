<?php
/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 27/12/18
 * Time: 14:21
 */

namespace App\Models;


use App\Http\Traits\LogSave;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    use LogSave;

    static $permisos = ['update', 'create', 'view', 'delete'];

    public $table = 'pages';
    public $fillable = ['titulo', 'slug', 'contenido', 'status'];



    public function getcontenidoAttribute($contenido) {
        return str_replace('<:url:>', url(''), $contenido);
    }

    public function setContenidoAttribute($value) {
        $this->attributes['contenido'] = str_replace(url(''), '<:url:>', $value);
    }


    public function getStatusStrAttribute() {
        if($this->status == 1) {
            return 'Publicado';
        }
        return 'Sin publicar';
    }

}