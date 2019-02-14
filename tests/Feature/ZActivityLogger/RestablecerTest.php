<?php

namespace Tests\Feature\ZActivityLogger;

use Tests\TestCase;
use App\Models\User;
use App\Models\Categoria;
use Silber\Bouncer\Database\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Activity;

class RestablecerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function restablecer_post()
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

        $activity = Activity::where('id_entity', $user[0]->id)
            ->where('entity', 'App\Models\User')
            ->where('methodType', 'POST')->get();

        $this->put(route('activity.restablecer', $activity[0]->id));

        $this->assertDatabaseMissing('users', [
            'name' => 'Test',
            'username' => 'usertest',
            'email' => 'test@mail.com',
        ]);
    }

    /** @test */
    public function restablecer_put()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $this->actingAs($this->createSuperadmin());

        $response = $this->put(route('usuarios.update', $userCreated), [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
            'comentarios' => 'test_act',
            'role' => $rol->id
        ]);

        $response = $response->getData()->success;

        $this->assertTrue($response);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $userCreated->id,
            'entity' => 'App\Models\User',
            'methodType' => 'PUT'
        ]);

        $activity = Activity::where('id_entity', $userCreated->id)
            ->where('entity', 'App\Models\User')
            ->where('methodType', 'PUT')->get();

        $this->put(route('activity.restablecer', $activity[0]->id));

        $this->assertDatabaseMissing('users', [
            'name' => 'User Test Actualizado',
            'username' => 'test_act',
            'email' => 'test_act@mail.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);
    }

    /** @test */
    public function restablecer_delete()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $this->actingAs($this->createSuperadmin());

        $this->delete(route('usuarios.destroy', $userCreated));

        $this->assertDatabaseMissing('users', [
            'id' => $userCreated->id
        ]);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $userCreated->id,
            'entity' => 'App\Models\User',
            'methodType' => 'DELETE'
        ]);

        $activity = Activity::where('id_entity', $userCreated->id)
            ->where('entity', 'App\Models\User')
            ->where('methodType', 'DELETE')->get();

        $this->put(route('activity.restablecer', $activity[0]->id));

        $this->assertDatabaseHas('users', [
            'id' => $userCreated->id,
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);
    }

    /** @test */
    public function restablecer_delete_con_relaciones()
    {
        $userCreated = factory(User::class)->create([
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);

        $categoriaCreated = factory(Categoria::class)->create([
            'descripcion' => 'test',
            'user_id' => $userCreated->id,
            'status' => 'test'
        ]);

        $categoriaCreated2 = factory(Categoria::class)->create([
            'descripcion' => 'test',
            'user_id' => $userCreated->id,
            'status' => 'test'
        ]);

        $rol = factory(Role::class)->create([
            'name' => 'testrol',
            'title' => 'Test Rol'
        ]);

        $userCreated->assign($rol->name);

        $this->actingAs($this->createSuperadmin());

        $this->delete(route('usuarios.destroy', $userCreated));

        $this->assertDatabaseMissing('users', [
            'id' => $userCreated->id
        ]);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $userCreated->id,
            'entity' => 'App\Models\User',
            'methodType' => 'DELETE'
        ]);

        $activity = Activity::where('id_entity', $userCreated->id)
            ->where('entity', 'App\Models\User')
            ->where('methodType', 'DELETE')->get();

        $this->put(route('activity.restablecer', $activity[0]->id));

        $this->assertDatabaseHas('users', [
            'id' => $userCreated->id,
            'name' => 'User Test',
            'username' => 'test',
            'email' => 'test@mail.com',
        ]);

        $this->assertDatabaseHas('categorias', [
            'id' => $categoriaCreated->id,
            'descripcion' => 'test',
            'user_id' => $userCreated->id,
            'status' => 'test'
        ]);

        $this->assertDatabaseHas('categorias', [
            'id' => $categoriaCreated2->id,
            'descripcion' => 'test',
            'user_id' => $userCreated->id,
            'status' => 'test'
        ]);
    }
}
