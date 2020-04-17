<?php


namespace App\ProTicket\Repositories;


use App\ProTicket\Models\StatusTicket;

/**
 * Class StatusTicketRepository
 * @package App\ProTicket\Repositories
 */
class StatusTicketRepository extends EloquentRepository
{
    public function __construct(StatusTicket $model)
    {
        parent::__construct($model);
    }
}