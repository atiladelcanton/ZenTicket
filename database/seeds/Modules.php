<?php

use App\Sigais\Models\Module;
use Illuminate\Database\Seeder;

class Modules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Module::create([
            'name' => 'Grupos',
            'slug' => str_slug('Grupos'),
            'icon' => 'icon-users',

        ]);
        Module::create([
            'name' => 'Usuários',
            'slug' => str_slug('Usu;arios'),
            'icon' => 'icon-user',

        ]);

    }
}
