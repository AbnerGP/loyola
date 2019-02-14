<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Categoria::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->text,
        'user_id' => 1,
        'status' => $faker->text,
    ];
});
