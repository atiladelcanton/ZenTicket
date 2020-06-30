<?php


namespace App\ProTicket\Services\Specializations\Ticket;

use App\ProTicket\Models\TimeLineTicket;

class FinishTrackingTicket
{
    private $ticketId;


    public function __construct(string $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function execute()
    {
        $timeline = TimeLineTicket::where('ticket_id', $this->ticketId)->orderBy('id', 'DESC')->first();
        $new = new ChangeStatusToFinish($this->ticketId);
        $new->execute();
        if (is_null($timeline->stop)) {

            $timeline->stop = now();
            $timeline->save();
        }
    }
}
