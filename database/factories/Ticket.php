<?php

/** @var Factory $factory */

use App\Model;
use App\ZenTicket\Models\Impact;
use App\ZenTicket\Models\Priority;
use App\ZenTicket\Models\Ticket;
use App\ZenTicket\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Ramsey\Uuid\Uuid;

$factory->define(Ticket::class, function (Faker $faker) {
    $project = factory(App\ZenTicket\Models\Project::class)->create();
    $ticketNumber = '';
    $projectName = explode(' ', $project->name);

    foreach ($projectName as $key => $value) {
        $ticketNumber .= substr($value, 0, 1);
    }
    $uuid = Uuid::uuid1();
    $ticketNumber .= explode('-', $uuid->toString())[0];

    return [
        'type_id' => factory(\App\ZenTicket\Models\TypeTicket::class)->create()->id,
        'project_id' => $project->id,
        'user_open_ticket' => factory(User::class)->create()->id,
        'priority_id' => factory(Priority::class)->create()->id,
        'impact_id' => factory(Impact::class)->create()->id,
        'status' => 'E',
        'responsible_ticket' => null,
        'ticket_number' => $ticketNumber,
        'title' => $faker->title,
        'description' => $faker->sentence(128)
    ];
});
