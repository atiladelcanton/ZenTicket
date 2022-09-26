<?php

/** @var Factory $factory */

use App\Model;
use App\ZenTicket\Models\Module;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Module::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'icon' => 'icon-bubbles',

    ];
});
