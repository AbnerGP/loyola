<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function superadmin_puede_ver_usuarios()
    {
        $this->actingAs($superadmin = $this->createSuperadmin());

        $this->get(route('usuarios.view'))
            ->assertStatus(200)
            ->assertViewIs('users.index');
    }

    /** @test */
    function admin_puede_ver_usuarios()
    {
        $this->actingAs($this->createAdmin());

        $this->get(route('usuarios.view'))
            ->assertStatus(200)
            ->assertViewIs('users.index');
    }

    /** @test */
    function usuario_no_puede_ver_usuarios()
    {
        $this->actingAs($this->createUser());

        $this->get(route('usuarios.view'))
            ->assertStatus(403);
    }

    /** @test */
    function invitados_no_pueden_ver_usuarios()
    {
        $this->get(route('usuarios.view'))
            ->assertStatus(302)
            ->assertRedirect('admin/login');
    }
}
