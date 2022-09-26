<?php

/** @var Factory $factory */

use App\Model;
use App\ZenTicket\Models\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
