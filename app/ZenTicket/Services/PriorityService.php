<?php


namespace App\ZenTicket\Services;


use App\ZenTicket\Contracts\ServiceContract;
use App\ZenTicket\Repositories\PriorityRepository;

class PriorityService implements ServiceContract
{
    private $priorityServiceRepository;

    public function __construct(PriorityRepository $priorityServiceRepository)
    {
        $this->priorityServiceRepository = $priorityServiceRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->priorityServiceRepository->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->priorityServiceRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->priorityServiceRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
        return $this->priorityServiceRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->priorityServiceRepository->delete($id);
    }
}
