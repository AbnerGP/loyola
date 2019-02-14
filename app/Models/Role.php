<?php

namespace App\Models;

use Silber\Bouncer\Database\Role as RoleBouncer;

class Role extends RoleBouncer
{
    static $permisos = ['update', 'create', 'view', 'delete'];
}
