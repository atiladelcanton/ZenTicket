<?php


namespace App\ProTicket\Services\Specializations\Ticket;

use App\ProTicket\Models\Ticket;

class ChangeStatusToProcessing
{
    private $ticketId;


    public function __construct(string $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function execute()
    {
        Ticket::where('id', $this->ticketId)->update(['status' => 'T', 'responsible_ticket' => auth()->user()->id]);
    }
}
