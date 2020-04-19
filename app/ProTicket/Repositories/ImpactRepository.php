<?php


namespace App\ProTicket\Repositories;


use App\ProTicket\Models\Impact;

/**
 * Class ImpactRepository
 * @package App\ProTicket\Repositories
 */
class ImpactRepository extends EloquentRepository
{
    public function __construct(Impact $model)
    {
        parent::__construct($model);
    }
}