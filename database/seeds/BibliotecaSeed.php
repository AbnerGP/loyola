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

        // Sección Quiénes somos
        $about = $this->getContentPage('about');
        $name_about = "¿Quienes Somos?";

        Page::create([
           'titulo' => $name_about,
            'slug' => str_slug($name_about),
            'contenido' => $about,
            'status' => 1,
        ]);

        $directorio = $this->getContentPage('directorio');
        Page::create([
            'titulo' => 'Directorio',
            'slug' => 'directorio',
            'contenido' => $directorio,
            'status' => 1,
        ]);

        $ubicacion = $this->getContentPage('ubicacion');
        Page::create([
            'titulo' => 'Nuestra ubicación',
            'slug' => 'ubicacion',
            'contenido' => $ubicacion,
            'status' => 1,
        ]);

        //Sección Niveles Educativos
        $level = $this->getContentPage('level');
        $name_level = "Niveles Educativos";

        Page::create([
            'titulo' => $name_level,
            'slug' => str_slug($name_level),
            'contenido' => $level,
            'status' => 1,
        ]);

        $kinder = $this->getContentPage('kinder');
        Page::create([
            'titulo' => 'Kinder',
            'slug' => 'kinder',
            'contenido' => $kinder,
            'status' => 1,
        ]);

        $primaria = $this->getContentPage('primaria');
        Page::create([
            'titulo' => 'Primaria',
            'slug' => 'primaria',
            'contenido' => $primaria,
            'status' => 1,
        ]);

        $secundaria = $this->getContentPage('secundaria');
        Page::create([
            'titulo' => 'Secundaria',
            'slug' => 'secundaria',
            'contenido' => $secundaria,
            'status' => 1,
        ]);

        $preparatoria = $this->getContentPage('preparatoria');
        Page::create([
            'titulo' => 'Preparatoria',
            'slug' => 'preparatoria',
            'contenido' => $preparatoria,
            'status' => 1,
        ]);

        $lang_school = $this->getContentPage('languageschool');
        Page::create([
            'titulo' => 'Language School',
            'slug' => 'language-school',
            'contenido' => $lang_school,
            'status' => 1,
        ]);

        $viajes = $this->getContentPage('viajes');
        Page::create([
            'titulo' => 'Viajes',
            'slug' => 'viajes',
            'contenido' => $viajes,
            'status' => 1,
        ]);


        //Sección logros
        $logros = $this->getContentPage('logros');
        $name_logros = "logros";

        Page::create([
            'titulo' => $name_logros,
            'slug' => str_slug($name_logros),
            'contenido' => $logros,
            'status' => 1,
        ]);

        $academicos = $this->getContentPage('academicos');
        Page::create([
            'titulo' => 'Logros académicos',
            'slug' => 'academicos',
            'contenido' => $academicos,
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
