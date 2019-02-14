<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Silber\Bouncer\Database\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_actualizar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function administrador_puede_actualizar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function usuarios_no_pueden_actualizar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $user = $this->createUser();
        $this->actingAs($user);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function invitados_no_pueden_actualizar_usuarios()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function superadmin_puede_actualizar_usuario_con_rol_superadmin()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Superadmin Test',
            'username' => 'supertest',
            'email' => 'supertest@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = Role::whereName('superadmin')->first();

        $userCreated->assign($rol->name);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Superadmin Test Actualizado',
            'username' => 'supertest_act',
            'email' => 'supertest_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'User Superadmin Test Actualizado',
            'username' => 'supertest_act',
            'email' => 'supertest_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function administrador_no_puede_actualizar_usuario_con_rol_superadmin()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Superadmin Test',
            'username' => 'supertest',
            'email' => 'supertest@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = Role::whereName('superadmin')->first();

        $userCreated->assign($rol->name);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Superadmin Test Actualizado',
            'username' => 'supertest_act',
            'email' => 'supertest_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response->assertStatus(500);

        $this->assertDatabaseMissing('users', [
            'name' => 'User Superadmin Test Actualizado',
            'username' => 'supertest_act',
            'email' => 'supertest_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function superadmin_no_puede_cambiarse_rol_de_superadmin()
    {
        $rolNuevo = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('usuarios.update', $superadmin), [
            'name' => 'User Superadmin Test Actualizado',
            'username' => 'supertest_act',
            'email' => 'supertest_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rolNuevo->id
        ]);

        $response->assertStatus(500);

        $this->assertDatabaseMissing('users', [
            'name' => 'User Superadmin Test Actualizado',
            'username' => 'supertest_act',
            'email' => 'supertest_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function superadmin_puede_asignar_rol_de_superadmin()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $rolSuper = Role::whereName('superadmin')->first();

        $userCreated->assign($rol->name);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rolSuper->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function superadmin_puede_cambiar_rol_a_otro_superadmin()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $rolSuper = Role::whereName('superadmin')->first();

        $userCreated->assign($rolSuper->name);

        $superadmin = $this->createSuperadmin();
        $this->actingAs($superadmin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }

    /** @test */
    public function admin_no_puede_asignar_rol_de_superadmin()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
            'comentarios' => 'test',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $rolSuper = Role::whereName('superadmin')->first();

        $userCreated->assign($rol->name);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rolSuper->id
        ]);

        $response->assertStatus(500);

        $this->assertDatabaseMissing('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
        ]);
    }
}
