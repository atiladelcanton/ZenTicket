<?php


namespace App\ZenTicket\Repositories;

use App\ZenTicket\Models\ProjectUser;

/**
 * Class ProjectUserRepository
 * @package App\ZenTicket\Repositories
 */
class ProjectUserRepository extends EloquentRepository
{
    public function __construct(ProjectUser $model)
    {
        parent::__construct($model);
    }
}
