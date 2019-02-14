<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();

        $this->createAbilities();

        Bouncer::allow('superadmin')->everything();
        Bouncer::allow('admin')->to(['view', 'create', 'update', 'delete'], User::class);
    }

    public function createRoles()
    {
        //Creamos rol de Superadmin
        Bouncer::role()->create([
            'name' => 'superadmin',
            'title' => 'Superadmin',
        ]);

        //Creamos rol de Administrador
        Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Administrador',
            'description' => 'Tiene acceso a la mayoría de permisos del sistema.'
        ]);

        //Creamos rol de Usuario
        Bouncer::role()->create([
            'name' => 'usuario',
            'title' => 'Usuario'
        ]);
    }

    public function createAbilities()
    {
        //Todas las habilidades
        Bouncer::ability()->create([
            'name' => '*',
            'title' => 'Control total',
            'entity_type' => '*'
        ]);

        Bouncer::ability()->createForModel(User::class, [
            'name' => 'view',
            'title' => 'Ver Usuarios'
        ]);

        Bouncer::ability()->createForModel(User::class, [
            'name' => 'create',
            'title' => 'Crear Usuarios'
        ]);

        Bouncer::ability()->createForModel(User::class, [
            'name' => 'update',
            'title' => 'Actualizar Usuarios'
        ]);


    }
}
