<?php

use Faker\Generator as Faker;

$factory->define(Silber\Bouncer\Database\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name(1),
        'title' => $faker->name(1)
    ];
});
