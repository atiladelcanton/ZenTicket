<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Administrator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => \Illuminate\Support\Facades\Hash::make('proTicket@2020'),
            'created_at' => now()
        ]);
    }
}
