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
];