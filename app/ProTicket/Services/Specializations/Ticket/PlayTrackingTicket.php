<?php


namespace App\ProTicket\Services\Specializations\Ticket;

use App\ProTicket\Models\TimeLineTicket;

class PlayTrackingTicket
{
    private $ticketId;


    public function __construct(string $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function execute()
    {
        $newTicket = TimeLineTicket::where('ticket_id', $this->ticketId)->first();

        if (is_null($newTicket)) {
            $new = new ChangeStatusToProcessing($this->ticketId);
            $new->execute();
        }
        TimeLineTicket::create(['ticket_id' => $this->ticketId, 'start' => now()]);
    }
}
