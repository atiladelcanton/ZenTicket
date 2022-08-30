<?php


use App\ZenTicket\Models\Module;
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
                'slug' => 'grupos',
                'icon' => 'icon-users',

            ]
        );
        Module::create(
            [
                'name' => 'Usuários',
                'slug' => 'usuarios',
                'icon' => 'icon-user',

            ]
        );
        Module::create(
            [
                'name' => 'Projetos',
                'slug' => 'projetos',
                'icon' => 'icon-screen-desktop',

            ]
        );
        Module::create(
            [
                'name' => 'Chamados',
                'slug' => 'chamados',
                'icon' => 'icon-bubbles',

            ]
        );

        $config = Module::create(
            [
                'name' => 'Configurações',
                'slug' => 'configuracoes',
                'icon' => 'icon-equalizer',

            ]
        );
        Module::create(
            [
                'name' => 'Prioridade',
                'slug' => 'prioridade',
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id

            ]
        );
        Module::create(
            [
                'name' => 'Tipos de Chamados',
                'slug' => 'tipos-de-chamados',
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id
            ]
        );
        Module::create(
            [
                'name' => 'Impactos',
                'slug' => 'impactos',
                'icon' => 'icon-bubbles',
                'parent_id' => $config->id
            ]
        );
    }
}
