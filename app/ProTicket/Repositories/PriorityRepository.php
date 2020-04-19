<?php


namespace App\ProTicket\Repositories;

use App\ProTicket\Models\Priority;

/**
 * Class PriorityRepository
 * @package App\ProTicket\Repositories
 */
class PriorityRepository extends EloquentRepository
{
    public function __construct(Priority $model)
    {
        parent::__construct($model);
    }
}