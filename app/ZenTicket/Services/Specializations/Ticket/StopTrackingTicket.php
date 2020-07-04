<?php


namespace App\ZenTicket\Services\Specializations\Ticket;

use App\ZenTicket\Models\TimeLineTicket;

class StopTrackingTicket
{
    private $ticketId;


    public function __construct(string $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function execute()
    {
        $timeLine = TimeLineTicket::where('ticket_id', $this->ticketId)->whereNull('stop')->first();
        $timeLine->stop = now();
        $timeLine->save();
    }
}
