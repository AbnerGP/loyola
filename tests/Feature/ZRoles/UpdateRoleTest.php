<?php

namespace Tests\Feature\Roles;

use Tests\TestCase;
use Silber\Bouncer\Database\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class UpdateRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_actualizar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Test Rol Actualizado',
            'description' => 'Rol actualizado'
        ]);

        $response = $response->getData()->status;
        $this->assertTrue($response);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Test Rol Actualizado',
        ]);
    }

    /** @test */
    public function administrador_puede_actualizar_roles_si_se_le_permite()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $admin = $this->createAdmin();
        $this->actingAs($admin);
        Bouncer::allow('admin')->to(['update'], \App\Models\Role::class);

        $response = $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Test Rol Actualizado',
            'description' => 'Rol actualizado'
        ]);

        $response = $response->getData()->status;
        $this->assertTrue($response);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Test Rol Actualizado',
        ]);
    }

    /** @test */
    public function administrador_no_puede_actualizar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Test Rol Actualizado',
            'description' => 'Rol actualizado'
        ])->assertStatus(403);

        $this->assertDatabaseMissing('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Test Rol Actualizado',
        ]);
    }

    /** @test */
    public function usuarios_no_pueden_actualizar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $user = $this->createUser();
        $this->actingAs($user);

        $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Test Rol Actualizado',
            'description' => 'Rol actualizado'
        ])->assertStatus(403);

        $this->assertDatabaseMissing('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Test Rol Actualizado',
        ]);
    }

    /** @test */
    public function invitados_no_pueden_actualizar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Test Rol Actualizado',
            'description' => 'Rol actualizado'
        ])->assertStatus(302)->assertRedirect('admin/login');

        $this->assertDatabaseMissing('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Test Rol Actualizado',
        ]);
    }

    /** @test */
    public function superadmin_puede_actualizar_rol_de_superadmin()
    {
        $rol = Role::whereName('superadmin')->first();

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Rol Superadmin Actualizado',
            'description' => 'Rol actualizado'
        ]);

        $response = $response->getData()->status;
        $this->assertTrue($response);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Rol Superadmin Actualizado',
        ]);
    }

    /** @test */
    public function admin_no_puede_actualizar_rol_de_superadmin()
    {
        $rol = Role::whereName('superadmin')->first();

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->put(route('roles.update', $rol), [
            'id_rol' => $rol->id,
            'name' => $rol->name,
            'title' => 'Rol Superadmin Actualizado',
            'description' => 'Rol actualizado'
        ])->assertStatus(403);

        $this->assertDatabaseMissing('bouncer_roles', [
            'id' => $rol->id,
            'title' => 'Rol Superadmin Actualizado',
        ]);
    }
}
