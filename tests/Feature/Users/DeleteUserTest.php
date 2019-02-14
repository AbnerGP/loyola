<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Silber\Bouncer\Database\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_eliminar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Delete Test'
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $this->delete(route('usuarios.destroy', $userCreated));

        $this->assertDatabaseMissing('users', [
            'id' => $userCreated->id
        ]);
    }

    /** @test */
    public function administrador_puede_eliminar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Delete Test'
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->delete(route('usuarios.destroy', $userCreated));

        $this->assertDatabaseMissing('users', [
            'id' => $userCreated->id
        ]);
    }

    /** @test */
    public function usuarios_no_pueden_eliminar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Delete Test'
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $user = $this->createUser();
        $this->actingAs($user);

        $this->delete(route('usuarios.destroy', $userCreated))
            ->assertStatus(403);

        $this->assertDatabaseHas('users', [
            'id' => $userCreated->id
        ]);
    }

    /** @test */
    public function invitados_no_pueden_eliminar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Delete Test'
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $this->delete(route('usuarios.destroy', $userCreated))
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $userCreated->id
        ]);
    }

    /** @test */
    public function usuario_superadmin_no_se_puede_eliminar()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Delete Test'
        ]);

        $rol = Role::whereName('superadmin')->first();

        $userCreated->assign($rol->name);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $this->delete(route('usuarios.destroy', $userCreated))
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $userCreated->id
        ]);
    }

    /** @test */
    public function ningun_usuario_se_puede_eliminar_a_si_mismo()
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $this->delete(route('usuarios.destroy', $admin))
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $admin->id
        ]);
    }
}
