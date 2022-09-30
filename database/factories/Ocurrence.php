<?php

/** @var Factory $factory */

use Faker\Generator as Faker;

use App\ZenTicket\Models\User;
use App\ZenTicket\Models\Ticket;
use App\ZenTicket\Models\Ocurrence;

$factory->define(Ocurrence::class, function (Faker $faker) {

    return [
        'ticket_id' => factory(Ticket::class)->create()->id,
        'description'=>$faker->sentence(100),
        'user_id' => factory(User::class)->create()->id,
    ];
});
