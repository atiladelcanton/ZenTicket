<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ZenTicket\Models\Impact;
use App\ZenTicket\Models\Priority;
use App\ZenTicket\Models\Project;
use App\ZenTicket\Models\Ticket;
use App\ZenTicket\Models\TypeTicket;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Ticket::class, function (Faker $faker) {
    $name = 'FR';
    $uuid = Uuid::uuid1();
    $name .= explode('-', $uuid->toString())[0];
    return [
        'type_id' => TypeTicket::all()->random(1)->first()->id,
        'project_id' => Project::all()->random(1)->first()->id,
        'user_open_ticket' => 3,
        'priority_id' => Priority::all()->random(1)->first()->id,
        'impact_id' => Impact::all()->random(1)->first()->id,
        'status' => 'E',
        'ticket_number' => $name,
        'title' => $faker->text(20),
        'description' => $faker->text(50)
    ];
});
