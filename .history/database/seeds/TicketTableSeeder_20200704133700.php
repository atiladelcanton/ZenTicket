<?php

use App\ProTicket\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ticket::class, 500)->create()->each(function ($post) {
            $this->command->info('Criado...');
            $post->save();
        });
    }
}
