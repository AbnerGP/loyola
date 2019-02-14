<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PerfilEditUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usuario_conectado_puede_modificar_su_perfil()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $response = $this->put(route('perfil.update'), [
            'name' => 'Perfil Test Actualizado',
            'email' => 'perfil_test_act@mail.com',
            'new_password' => 'nuevacontra',
            'new_password_confirmation' => 'nuevacontra',
            'password' => 'secret'
        ]);

        $response = $response->getData()->status;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'Perfil Test Actualizado',
            'email' => 'perfil_test_act@mail.com',
        ]);
    }
}
