<?php

namespace App\Models;

use App\Http\Traits\LogSave;
use App\Notifications\ResetPasswordNotification;
use Bouncer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities, LogSave;

    static $permisos = ['update', 'create', 'view', 'delete'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'comentarios', 'password',
    ];

    protected $allRelations = [
        'categorias',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function isSuperadmin()
    {
        return Bouncer::is($this)->a('superadmin');
    }

    public function isAdmin()
    {
        return Bouncer::is($this)->an('admin');
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
