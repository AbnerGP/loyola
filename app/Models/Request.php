<?php

namespace App\Models;

use App\Http\Traits\LogSave;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use LogSave;

    static $permisos = ['update', 'create', 'view', 'delete'];
    public $fillable = [
        'type', 'date', 'level', 'name', 'last_name', 'mat_last_name', 'curp', 'grade', 'sanguine', 'place_birth',
        'birthday', 'age', 'street', 'number', 'colony', 'town', 'zip_code', 'origin_school', 'f_name', 'f_last_name',
        'f_mat_last_name', 'f_company', 'f_position', 'f_office_phone', 'f_home_phone', 'f_cellphone', 'f_email',
        'm_name', 'm_last_name', 'm_mat_last_name', 'm_company', 'm_position', 'm_office_phone', 'm_home_phone',
        'm_cellphone', 'm_email', 'o_name', 'o_last_name', 'o_mat_last_name', 'relationship', 'o_office_phone',
        'o_home_phone', 'o_cellphone', 'o_email', 'observations', 'authorization'
    ];
}
