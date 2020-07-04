<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\Ticket;

/**
 * Class TicketRepository
 * @package App\ZenTicket\Repositories
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

    public function totalTickets(string $status)
    {
        return $this->model->whereStatus($status)->count();
    }
}
