<?php


namespace App\ProTicket\Services\Specializations;

use App\ProTicket\Models\TimeLineTicket;
use Carbon\Carbon;

class CalculateHoursWorked
{
    private $timesWorkeds;

    public function __construct(int $ticketId)
    {
        $this->timesWorkeds =  TimeLineTicket::where('ticket_id', $ticketId)->select('start', 'stop')->get();
    }

    public function calculate()
    {
        $total = [];
        $all_seconds = 0;
        foreach ($this->timesWorkeds as $time) {
            if ($time->stop != null) {

                array_push($total, $time->stop->diff($time->start)->format('%H:%I:%S'));
            }
        }

        foreach ($total as $time) {

            list($hour, $minute, $second) = explode(':', $time);
            $all_seconds += $hour * 3600;
            $all_seconds += $minute * 60;
            $all_seconds += $second;
        }


        $total_minutes = floor($all_seconds / 60);
        $seconds = $all_seconds % 60;
        $hours = floor($total_minutes / 60);
        $minutes = $total_minutes % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
