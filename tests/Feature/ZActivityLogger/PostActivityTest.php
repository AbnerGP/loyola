<?php

namespace Tests\Feature\ZActivityLogger;

use App\Models\Activity;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostActivityTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function se_registra_actividad_al_crear_elemento()
    {
        $this->actingAs($this->createSuperadmin());

        $response = $this->post(route('usuarios.store'), [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => 'usuario'
        ]);

        $response = $response->getData()->status;

        $this->assertTrue($response);

        $user = User::where('name', 'test')
            ->where('username', 'usertest')
            ->get();

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $user[0]->id,
            'entity' => 'App\Models\User',
            'methodType' => 'POST'
        ]);
    }
}
