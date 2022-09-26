<?php

/** @var Factory $factory */

use App\ZenTicket\Models\Impact;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Impact::class, function (Faker $faker) {
    return [

        'name' => $faker->name,
        'color' => $faker->hexColor
    ];
});
