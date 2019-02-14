<?php

namespace Tests\Feature\ZActivityLogger;

use App\Models\User;
use Silber\Bouncer\Database\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PutActivityTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function se_registra_actividad_al_modificar_elemento()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $this->actingAs($this->createSuperadmin());

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $userCreated->id,
            'entity' => 'App\Models\User',
            'methodType' => 'PUT'
        ]);
    }
}
