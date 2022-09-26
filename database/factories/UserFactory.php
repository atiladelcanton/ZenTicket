<?php

/** @var Factory $factory */

use App\ZenTicket\Models\Role;
use App\ZenTicket\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
$factory->define(User::class, function (Faker $faker) {
    $role = factory(Role::class)->create();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'role_id' => $role->id
    ];
});
