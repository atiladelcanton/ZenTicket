<?php


namespace App\ProTicket\Services\Specializations;

use App\ProTicket\Models\TimeLineTicket;

class CalculateHoursWorked
{
    private $timesWorkeds;

    public function __construct(int $ticketId)
    {
        $this->timesWorkeds =  TimeLineTicket::where('ticket_id', $ticketId)->pluck('start', 'stop')->toArray();;
    }

    public function calculate()
    {
        $total = 0;
        foreach ($this->timesWorkeds as $time) {
            $temp = explode(":", $time);
            $total += (int) $temp[0] * 3600;
            $total += (int) $temp[1] * 60;
            $total += (int) $temp[2];
        }

        return sprintf(
            '%02d:%02d:%02d',
            ($total / 3600),
            ($total / 60 % 60),
            $total % 60
        );
    }
}
