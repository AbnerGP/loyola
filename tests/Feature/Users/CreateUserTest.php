<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_crear_usuarios()
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

        $this->assertDatabaseHas('users', [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);
    }

    /** @test */
    public function administrador_puede_crear_usuarios()
    {
        $this->actingAs($this->createAdmin());

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

        $this->assertDatabaseHas('users', [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);
    }

    /** @test */
    public function usuarios_no_pueden_crear_usuarios()
    {
        $this->actingAs($this->createUser());

        $response = $this->post(route('usuarios.store'), [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => 'usuario'
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('users', [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);
    }

    /** @test */
    public function invitados_no_pueden_crear_usuarios()
    {
        $response = $this->post(route('usuarios.store'), [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => 'usuario'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);
    }

    /** @test */
    public function superadmin_puede_crear_usuario_con_rol_superadmin()
    {
        $this->actingAs($this->createSuperadmin());

        $response = $this->post(route('usuarios.store'), [
            'name' => 'Superadmin Test',
            'username' => 'superadmintest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => 'superadmin'
        ]);
        $response = $response->getData()->status;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'Superadmin Test',
            'username' => 'superadmintest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);
    }

    /** @test */
    public function administrador_no_puede_crear_usuario_con_rol_superadmin()
    {
        $this->actingAs($this->createAdmin());

        $this->post(route('usuarios.store'), [
            'name' => 'Superadmin Test',
            'username' => 'superadmintest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => 'superadmin'
        ])->assertStatus(500);

        $this->assertDatabaseMissing('users', [
            'name' => 'Superadmin Test',
            'username' => 'superadmintest',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);
    }
}
