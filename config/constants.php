<?php
use App\Models\{
    User,
    Page,
    Role,
    Media,
    Blog,
    Libro,
    Categoria
};

return [
    'models' => [
        Role::class,
        User::class,
        Page::class,
        Media::class,
        Blog::class,
        Libro::class,
        Categoria::class,
    ],

    'functions' => [
        'view-activity',
        'restore-activity',
        'migrate-biblioteca'
    ],

    'levels' => [
        'cendi' => 'CENDI',
        'primaria' => 'Primaria',
        'secundaria' => 'Secundaria',
        'preparatoria' => 'Preparatoria'
    ],

    'template_admin' => env('TEMPLATE_ADMIN', null)
];