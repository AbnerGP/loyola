<?php

namespace Tests\Feature\Libros;

use App\Models\Libro;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class UpdateLibrosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_actualizar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->actingAs($this->createSuperadmin());

        $response = $this->put(route('libros.update', $libroCreado), [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
            'keywords' => 'keywords, actualizado',
            'autor' => 'autor test',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ]);

        $ok = false;

        if($response->getData()->status == 'ok')
            $ok = true;

        $this->assertTrue($ok);

        $this->assertDatabaseHas('libros', [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
        ]);
    }

    /** @test */
    public function usuario_con_permisos_puede_actualizar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->actingAs($this->createUser());
        Bouncer::allow('user')->to(['update'], \App\Models\Libro::class);

        $response = $this->put(route('libros.update', $libroCreado), [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
            'keywords' => 'keywords, actualizado',
            'autor' => 'autor test',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ]);

        $ok = false;

        if($response->getData()->status == 'ok')
            $ok = true;

        $this->assertTrue($ok);

        $this->assertDatabaseHas('libros', [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
        ]);
    }

    /** @test */
    public function usuario_sin_permisos_no_puede_actualizar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->actingAs($this->createUser());

        $this->put(route('libros.update', $libroCreado), [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
            'keywords' => 'keywords, actualizado',
            'autor' => 'autor test',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ])->assertStatus(403);

        $this->assertDatabaseMissing('libros', [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
        ]);
    }

    /** @test */
    public function invitado_no_puede_actualizar_libros()
    {
        $libroCreado = factory(Libro::class)->create([
            'nombre' => 'Test',
            'descripcion' => 'Libro Test'
        ]);

        $this->put(route('libros.update', $libroCreado), [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
            'keywords' => 'keywords, actualizado',
            'autor' => 'autor test',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ])->assertStatus(302);

        $this->assertDatabaseMissing('libros', [
            'nombre' => 'Test Actualizado',
            'descripcion' => 'Libro Test Actualizado',
        ]);
    }
}
