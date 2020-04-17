<?php


namespace App\ProTicket\Services;


use App\ProTicket\Contracts\ServiceContract;
use App\ProTicket\Repositories\StatusTicketRepository;

class StatusTicketService implements ServiceContract
{
    private $statusTicket;

    public function __construct(StatusTicketRepository $statusTicketRepository)
    {
        $this->statusTicket = $statusTicketRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {

        return $this->statusTicket->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
       return  $this->statusTicket->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
       return  $this->statusTicket->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
       return  $this->statusTicket->create($data);
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->statusTicket->delete($id);
    }
}