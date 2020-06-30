<?php


namespace App\ProTicket\Services\Specializations;

use App\ProTicket\Models\ProjectUser;

class VinculeProjectUsers
{
    private $projectId;
    private $users;

    public function __construct(array $users, int $projectId)
    {
        $this->users = $users;
        $this->projectId = $projectId;
    }

    public function vincule()
    {
        if (ProjectUser::where('project_id', $this->projectId)->get()) {
            ProjectUser::where('project_id', $this->projectId)->delete();
        }
        foreach ($this->users as $user) {
            ProjectUser::create([
                'user_id' => $user,
                'project_id' => $this->projectId
            ]);
        }
    }
}
