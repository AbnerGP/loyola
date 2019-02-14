<?php

namespace Tests\Feature\Libros;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Bouncer;

class ViewLibrosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_puede_visualizar_libros()
    {
        $this->actingAs($this->createSuperadmin());

        $this->get(route('libros.view'))
            ->assertStatus(200)
            ->assertViewIs('libros.index');
    }

    /** @test */
    public function usuario_con_permisos_puede_visualizar_libros()
    {
        $this->actingAs($this->createUser());
        Bouncer::allow('user')->to(['view'], \App\Models\Libro::class);

        $this->get(route('libros.view'))
            ->assertStatus(200)
            ->assertViewIs('libros.index');
    }

    /** @test */
    public function usuario_sin_permisos_no_puede_visualizar_libros()
    {
        $this->actingAs($this->createUser());

        $this->get(route('libros.view'))
            ->assertStatus(403);
    }

    /** @test */
    public function invitados_no_pueden_visualizar_libros()
    {
        $this->get(route('libros.view'))
            ->assertStatus(302);
    }
}
