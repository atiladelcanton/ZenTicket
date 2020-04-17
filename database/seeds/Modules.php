<?php


use App\ProTicket\Models\Module;
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
        Module::create(
            [
                'name' => 'Grupos',
                'slug' => str_slug('Grupos'),
                'icon' => 'icon-users',

            ]
        );
        Module::create(
            [
                'name' => 'Usuários',
                'slug' => str_slug('Usuários'),
                'icon' => 'icon-user',

            ]
        );
        Module::create(
            [
                'name' => 'Projetos',
                'slug' => str_slug('Projetos'),
                'icon' => 'icon-screen-desktop',

            ]
        );
        Module::create(
            [
                'name' => 'Chamados',
                'slug' => str_slug('Chamados'),
                'icon' => 'icon-bubbles',

            ]
        );

        $config = Module::create(
            [
                'name' => 'Configurações',
                'slug' => '#',
                'icon' => 'icon-equalizer',

            ]
        );
        Module::create(
            [
                'name' => 'Sla',
                'slug' => str_slug('Sla'),
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id

            ]
        );
        Module::create(
            [
                'name' => 'Tipos de Chamados',
                'slug' => str_slug('Tipos de Chamados'),
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id
            ]
        );
        Module::create(
            [
                'name' => 'Impactos',
                'slug' => str_slug('Impactos'),
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id
            ]
        );
        Module::create(
            [
                'name' => 'Status Ticket',
                'slug' => str_slug('Status Ticket'),
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id
            ]
        );
    }
}
