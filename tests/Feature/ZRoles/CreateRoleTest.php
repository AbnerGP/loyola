<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;
use App\Models\Role;

class CreateRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_crear_rol()
    {
        $this->actingAs($this->createSuperadmin());

        $response = $this->post('admin/roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
            'permisos' => [
                'User/create',
                'User/update'
            ]
        ]);

        $response = $response->getData()->status;

        $this->assertTrue($response);

        /*$this->assertDatabaseHas('bouncer_roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
        ]);*/
    }

    /** @test */
    public function administrador_no_puede_crear_rol()
    {
        $this->actingAs($this->createAdmin());

        $response = $this->post('admin/roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
            'permisos' => [
                'User/create',
                'User/update'
            ]
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('bouncer_roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
        ]);
    }

    /** @test */
    public function administrador_puede_crear_rol_si_se_le_da_el_permiso()
    {
        $this->actingAs($this->createAdmin());
        Bouncer::allow('admin')->to(['create'], Role::class);

        $response = $this->post('admin/roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
            'permisos' => [
                'User/create',
                'User/update'
            ]
        ]);

        $response = $response->getData()->status;

        $this->assertTrue($response);

        /*$this->assertDatabaseHas('bouncer_roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
        ]);*/
    }

    /** @test */
    public function usuarios_no_pueden_crear_rol()
    {
        $this->actingAs($this->createUser());

        $response = $this->post('admin/roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
            'permisos' => [
                'User/create',
                'User/update'
            ]
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('bouncer_roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
        ]);
    }

    /** @test */
    public function usuarios_pueden_crear_rol_si_se_les_da_el_permiso()
    {
        $this->actingAs($this->createUser());
        Bouncer::allow('user')->to(['create'], Role::class);

        $response = $this->post('admin/roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
            'permisos' => [
                'User/create',
                'User/update'
            ]
        ]);

        $response = $response->getData()->status;

        $this->assertTrue($response);
    }

    /** @test */
    public function invitados_no_pueden_crear_rol()
    {
        $response = $this->post('admin/roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
            'permisos' => [
                'User/create',
                'User/update'
            ]
        ]);

        $response->assertStatus(302)
            ->assertRedirect('admin/login');

        $this->assertDatabaseMissing('bouncer_roles', [
            'name' => 'roltest',
            'title' => 'Rol Test',
            'description' => 'Rol TestCase',
        ]);
    }
}
