<?php

/** @var Factory $factory */

use App\ZenTicket\Models\Priority;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Priority::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'sla' => '02:00',
        'color' => $faker->hexColor
    ];
});
