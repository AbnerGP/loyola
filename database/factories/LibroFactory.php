<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Libro::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->text,
        'keywords' => $faker->text,
        'autor' => $faker->name,
    ];
});
