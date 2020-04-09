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
            'name' => 'Administrador Cliente',
            'email' => 'atilarampazo@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('clienteSigais@2019'),
            'created_at' => now()
        ]);
    }
}
