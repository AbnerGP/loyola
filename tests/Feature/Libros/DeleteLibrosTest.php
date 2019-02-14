<?php

namespace Tests\Feature\Libros;

use App\Models\Libro;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class DeleteLibrosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_eliminar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->actingAs($this->createSuperadmin());

        $this->delete(route('libros.destroy', $libroCreado));

        $this->assertDatabaseMissing('libros', [
            'id' => $libroCreado->id
        ]);
    }

    /** @test */
    public function usuario_con_permisos_puede_eliminar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->actingAs($this->createUser());
        Bouncer::allow('user')->to(['delete'], \App\Models\Libro::class);

        $this->delete(route('libros.destroy', $libroCreado));

        $this->assertDatabaseMissing('libros', [
            'id' => $libroCreado->id
        ]);
    }

    /** @test */
    public function usuario_sin_permisos_no_puede_eliminar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->actingAs($this->createUser());

        $this->delete(route('libros.destroy', $libroCreado))->assertStatus(403);
    }

    /** @test */
    public function invitado_no_puede_eliminar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->delete(route('libros.destroy', $libroCreado))->assertStatus(302);
    }
}
