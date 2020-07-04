<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\TypeTicket;

/**
 * Class TypeTicketsRepository
 * @package App\ZenTicket\Repositories
 */
class TypeTicketRepository extends EloquentRepository
{
    public function __construct(TypeTicket $model)
    {
        parent::__construct($model);
    }
}
