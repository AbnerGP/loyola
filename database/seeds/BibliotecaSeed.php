<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class BibliotecaSeed extends Seeder
{

    /**
     * @param $name
     * @return bool|string
     */

    public function getContentPage($name) {
        return file_get_contents(__DIR__.'/biblioteca/'.$name);
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $inicio = $this->getContentPage('inicio');

        Page::create([
            'titulo' => 'Inicio',
            'slug' => '/',
            'contenido' => $inicio,
            'status' => 1,
        ]);

        $about = $this->getContentPage('about');
        $name_about = "¿Quienes Somos?";

        Page::create([
           'titulo' => $name_about,
            'slug' => str_slug($name_about),
            'contenido' => $about,
            'status' => 1,
        ]);

        $level = $this->getContentPage('level');
        $name_level = "Niveles Educativos";

        Page::create([
            'titulo' => $name_level,
            'slug' => str_slug($name_level),
            'contenido' => $level,
            'status' => 1,
        ]);

        $logros = $this->getContentPage('logros');
        $name_logros = "Nuestros logros";

        Page::create([
            'titulo' => $name_logros,
            'slug' => str_slug($name_logros),
            'contenido' => $logros,
            'status' => 1,
        ]);

        $instalaciones = $this->getContentPage('instalaciones');
        $name_instalaciones = "Instalaciones";

        Page::create([
            'titulo' => $name_instalaciones,
            'slug' => str_slug($name_instalaciones),
            'contenido' => $instalaciones,
            'status' => 1,
        ]);

        $contacto = $this->getContentPage('contacto');
        $name_contacto = 'Contacto';

        Page::create([
            'titulo' => $name_contacto,
            'slug' => str_slug($name_contacto),
            'contenido' => $contacto,
            'status' => 1,
        ]);

    }
}
