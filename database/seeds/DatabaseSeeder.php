<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Administrator::class);
        $this->call(Modules::class);
        $this->call(Permissions::class);
        $this->call(Roles::class);
        $this->call(RoleAdministrator::class);
        $this->call(RoleModules::class);
        $this->call(RolePermissions::class);
    }
}
