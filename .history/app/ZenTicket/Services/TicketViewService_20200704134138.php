<?php

namespace App\ZenTicket\Services;

use App\ZenTicket\Contracts\ServiceContract;
use App\ZenTicket\Repositories\TicketViewRepository;

class TicketViewService implements ServiceContract
{
    private $ticketView;

    public function __construct(TicketViewRepository $ticketViewRepository)
    {
        $this->ticketView = $ticketViewRepository;
    }

    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {

        return $this->ticketView->getAll($column, $orderColum);
    }

    public function renderByFilter(array $filter)
    {
        return $this->ticketView->getByFilter($filter);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->ticketView->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->ticketView->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
        return $this->ticketView->create($data);
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->ticketView->delete($id);
    }
}
