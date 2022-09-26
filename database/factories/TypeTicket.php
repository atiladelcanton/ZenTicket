<?php

/** @var Factory $factory */

use App\ZenTicket\Models\TypeTicket;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(TypeTicket::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'color' => $faker->hexColor,
        'icon' => $faker->imageUrl(120, 120)
    ];
});
