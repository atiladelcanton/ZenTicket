<?php



/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model;
use App\ZenTicket\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        "name" => $faker->company,
        "logo" => $faker->hexColor,
        "responsible_name" => $faker->name,
        "responsible_email" => $faker->companyEmail,
        "hash_identify" => $faker->sha1
    ];
});
