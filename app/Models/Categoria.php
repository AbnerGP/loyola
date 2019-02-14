<?php

namespace App\Models;

use App\Http\Traits\LogSave;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use LogSave;

    static $permisos = ['update', 'create', 'view', 'delete'];

    protected $fillable = [
        'descripcion', 'user_id', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
