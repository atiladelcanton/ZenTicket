<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\Ocurrence;

/**
 * Class OcurrenceRepository
 * @package App\ZenTicket\Repositories
 */
class OcurrenceRepository extends EloquentRepository
{
    public function __construct(Ocurrence $model)
    {
        parent::__construct($model);
    }
}
