<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\Impact;

/**
 * Class ImpactRepository
 * @package App\ZenTicket\Repositories
 */
class ImpactRepository extends EloquentRepository
{
    public function __construct(Impact $model)
    {
        parent::__construct($model);
    }
}
