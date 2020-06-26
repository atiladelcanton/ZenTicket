<?php


namespace App\ProTicket\Repositories;


use App\ProTicket\Models\Ticket;

/**
 * Class TicketRepository
 * @package App\ProTicket\Repositories
 */
class TicketRepository extends EloquentRepository
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    public function getTicketByTicketNumber($ticketNumber)
    {
        return $this->model->where('ticket_number', $ticketNumber)->first();
    }
}
