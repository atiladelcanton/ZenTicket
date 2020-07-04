<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\StatusTicket;

/**
 * Class StatusTicketRepository
 * @package App\ZenTicket\Repositories
 */
class StatusTicketRepository extends EloquentRepository
{
    public function __construct(StatusTicket $model)
    {
        parent::__construct($model);
    }
}
