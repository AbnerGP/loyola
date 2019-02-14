<?php

namespace Tests\Feature\ZActivityLogger;

use App\Models\Categoria;
use App\Models\User;
use Silber\Bouncer\Database\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteActivityTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function se_registra_actividad_al_eliminar_elemento()
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
    }

    /** @test */
    public function se_registra_actividad_al_eliminar_elemento_con_relaciones()
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

        $this->assertDatabaseMissing('categorias', [
            'id' => $categoriaCreated->id
        ]);

        $this->assertDatabaseMissing('categorias', [
            'id' => $categoriaCreated2->id
        ]);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $userCreated->id,
            'entity' => 'App\Models\User',
            'methodType' => 'DELETE'
        ]);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $categoriaCreated->id,
            'entity' => 'App\Models\Categoria',
            'methodType' => 'DELETE'
        ]);

        $this->assertDatabaseHas('laravel_logger_activity', [
            'id_entity' => $categoriaCreated2->id,
            'entity' => 'App\Models\Categoria',
            'methodType' => 'DELETE'
        ]);
    }
}
