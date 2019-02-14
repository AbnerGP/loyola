<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_ver_lista_de_roles()
    {
        $this->actingAs($this->createSuperadmin());

        $response = $this->get(route('roles.view'));

        $response->assertStatus(200)
            ->assertViewIs('roles.index');
    }

    /** @test */
    public function administrador_puede_ver_lista_de_roles_si_se_le_permite()
    {
        $this->actingAs($this->createAdmin());
        Bouncer::allow('admin')->to(['view'], \App\Models\Role::class);

        $response = $this->get(route('roles.view'));

        $response->assertStatus(200)
            ->assertViewIs('roles.index');
    }

    /** @test */
    public function administrador_no_puede_ver_lista_de_roles()
    {
        $this->actingAs($this->createAdmin());

        $response = $this->get(route('roles.view'));

        $response->assertStatus(403);
    }

    /** @test */
    public function usuarios_no_pueden_ver_lista_de_roles()
    {
        $this->actingAs($this->createUser());

        $response = $this->get(route('roles.view'));

        $response->assertStatus(403);
    }

    /** @test */
    public function invitados_no_pueden_ver_lista_de_roles()
    {
        $this->get(route('roles.view'))
            ->assertStatus(302)
            ->assertRedirect('admin/login');
    }
}
