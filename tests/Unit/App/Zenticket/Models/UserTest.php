<?php

namespace Tests\Unit\App\Zenticket\Models;


use App\ZenTicket\Models\Module;
use App\ZenTicket\Models\Permission;
use App\ZenTicket\Models\Project;
use App\ZenTicket\Models\ProjectUser;
use App\ZenTicket\Models\Role;
use App\ZenTicket\Models\User;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tests\Unit\ModelTestCase;

class UserTest extends ModelTestCase
{
    public function testProjectsHasUser()
    {
        $projects = factory(Project::class)->create();
        $user = factory(User::class)->create();
        ProjectUser::create(['user_id' => $user->id, 'project_id' => $projects->id]);
        $user->refresh();

        $this->assertInstanceOf(ProjectUser::class, $user->projectsUser[0]);
        $this->assertCount(1, $user->projectsUser);
    }

    use RefreshDatabase;

    public function testHasRole()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $user->roles()->save($role);
        $user->refresh();
        $this->assertNotNull($user->role_id);
        $this->assertInstanceOf(\Artesaos\Defender\Role::class, $user->roles[0]);
        $this->assertCount(1, $user->roles);
    }


    protected function model(): User
    {
        return new User();
    }

    protected function traits(): array
    {
        return [
            HasDefender::class,
            Notifiable::class

        ];
    }

    protected function fillables(): array
    {
        return [
            'name',
            'email',
            'password',
            'role_id'
        ];
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'id' => 'int'
        ];
    }
}
