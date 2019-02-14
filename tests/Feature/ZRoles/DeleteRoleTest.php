<?php

namespace Tests\Feature\ZRoles;

use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Silber\Bouncer\Database\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;


class DeleteRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_eliminar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $this->delete(route('roles.destroy', $rol));

        $this->assertDatabaseMissing('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'testrol',
            'title' => 'Test Rol',
        ]);
    }

    /** @test */
    public function administrador_puede_eliminar_roles_si_se_le_da_permisos()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $admin = $this->createAdmin();
        $this->actingAs($admin);
        Bouncer::allow('admin')->to(['delete'], \App\Models\Role::class);

        $this->delete(route('roles.destroy', $rol));

        $this->assertDatabaseMissing('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'testrol',
            'title' => 'Test Rol',
        ]);
    }

    /** @test */
    public function administrador_no_puede_eliminar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->delete(route('roles.destroy', $rol))->assertStatus(403);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'testrol',
            'title' => 'Test Rol',
        ]);
    }

    /** @test */
    public function usuarios_no_pueden_eliminar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $user = $this->createUser();
        $this->actingAs($user);

        $this->delete(route('roles.destroy', $rol))->assertStatus(403);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'testrol',
            'title' => 'Test Rol',
        ]);
    }

    /** @test */
    public function invitados_no_pueden_eliminar_roles()
    {
        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $this->delete(route('roles.destroy', $rol))->assertStatus(302);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'testrol',
            'title' => 'Test Rol',
        ]);
    }

    /** @test */
    public function superadmin_no_puede_eliminar_rol_de_superadmin()
    {
        $rol = Role::whereName('superadmin')->first();

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $this->delete(route('roles.destroy', $rol))->assertStatus(302);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'superadmin',
        ]);
    }

    /** @test */
    public function administrador_no_puede_eliminar_rol_de_superadmin()
    {
        $rol = Role::whereName('superadmin')->first();

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->delete(route('roles.destroy', $rol))->assertStatus(403);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $rol->id,
            'name' => 'superadmin',
        ]);
    }

    /** @test */
    public function administrador_no_puede_eliminar_su_propio_rol()
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->delete(route('roles.destroy', $admin->roles->first()))->assertStatus(403);

        $this->assertDatabaseHas('bouncer_roles', [
            'id' => $admin->roles->first()->id,
            'name' => 'admin',
        ]);
    }
}
