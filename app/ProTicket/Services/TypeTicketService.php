<?php


namespace App\ProTicket\Services;


use App\ProTicket\Contracts\ServiceContract;
use App\ProTicket\Repositories\TypeTicketRepository;

class TypeTicketService implements ServiceContract
{
    private $typeTicketRepository;

    public function __construct(TypeTicketRepository $typeTicketRepository)
    {
        $this->typeTicketRepository = $typeTicketRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->typeTicketRepository->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->typeTicketRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->typeTicketRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
        return $this->typeTicketRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->typeTicketRepository->delete($id);
    }
}