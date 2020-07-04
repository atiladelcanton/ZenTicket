<?php


namespace App\ZenTicket\Repositories;

use App\ZenTicket\Models\Priority;

/**
 * Class PriorityRepository
 * @package App\ZenTicket\Repositories
 */
class PriorityRepository extends EloquentRepository
{
    public function __construct(Priority $model)
    {
        parent::__construct($model);
    }
}
