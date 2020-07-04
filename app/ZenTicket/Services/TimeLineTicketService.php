<?php


namespace App\ZenTicket\Services;

use App\ZenTicket\Contracts\ServiceContract;
use App\ZenTicket\Repositories\TicketRepository;
use App\ZenTicket\Repositories\TimeLineTicketRepository;
use App\ZenTicket\Services\Specializations\Ticket\FinishTrackingTicket;
use App\ZenTicket\Services\Specializations\Ticket\PlayTrackingTicket;
use App\ZenTicket\Services\Specializations\Ticket\StopTrackingTicket;

class TimeLineTicketService implements ServiceContract
{
    private $timelineTicketRepository;
    private $ticketRepository;
    public function __construct(TimeLineTicketRepository $timelineTicketRepository, TicketRepository $ticketRepository)
    {
        $this->timelineTicketRepository = $timelineTicketRepository;
        $this->ticketRepository = $ticketRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->timelineTicketRepository->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->timelineTicketRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->timelineTicketRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
        return $this->timelineTicketRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->timelineTicketRepository->delete($id);
    }

    public function storeTrack(array $data)
    {
        $ticket = $this->ticketRepository->getTicketByTicketNumber($data['ticketNumber']);
        switch ($data['action']) {
            case 'play':
                $track = new PlayTrackingTicket($ticket->id);
                break;
            case 'pause':
                $track = new StopTrackingTicket($ticket->id);
                break;
            default:
                $track = new FinishTrackingTicket($ticket->id);
                break;
        }
        $track->execute();

        $tracks = $this->timelineTicketRepository->returnAllTrackByTicket($ticket->id);
        $returnTracks = [];
        foreach ($tracks as $track) {
            array_push($returnTracks, [
                'created_at' => $track->created_at->format('d/m/Y'),
                'start' => $track->start->format('H:i:s'),
                'stop' => $track->stop ?  $track->stop->format('H:i:s') : '',
                'diff' => $track->stop ? $track->stop->diff($track->start)->format('%H:%I:%S') : ''
            ]);
        }

        return $returnTracks;
    }
}
