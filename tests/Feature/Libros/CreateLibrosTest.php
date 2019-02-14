<?php

namespace Tests\Feature\Libros;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class CreateLibrosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_crear_libros()
    {
        $this->actingAs($this->createSuperadmin());

        $response = $this->post(route('libros.store'), [
            'nombre' => 'Test',
            'descripcion' => 'Libro test',
            'keywords' => 'keyword,test,libro create',
            'autor' => 'test',
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
    }

    /** @test */
    public function usuario_con_permisos_puede_crear_libros()
    {
        $this->actingAs($this->createUser());
        Bouncer::allow('user')->to(['create'], \App\Models\Libro::class);

        $response = $this->post(route('libros.store'), [
            'nombre' => 'Test',
            'descripcion' => 'Libro test',
            'keywords' => 'keyword,test,libro create',
            'autor' => 'test',
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
    }

    /** @test */
    public function usuario_sin_permisos_no_puede_crear_libros()
    {
        $this->actingAs($this->createUser());

        $this->post(route('libros.store'), [
            'nombre' => 'Test',
            'descripcion' => 'Libro test',
            'keywords' => 'keyword,test,libro create',
            'autor' => 'test',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ])->assertStatus(403);
    }

    /** @test */
    public function invitado_no_puede_crear_libros()
    {
        $this->post(route('libros.store'), [
            'nombre' => 'Test',
            'descripcion' => 'Libro test',
            'keywords' => 'keyword,test,libro create',
            'autor' => 'test',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ])->assertStatus(302);
    }
}
