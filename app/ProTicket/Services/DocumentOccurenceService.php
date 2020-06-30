<?php


namespace App\ProTicket\Services;


use App\ProTicket\Contracts\ServiceContract;
use App\ProTicket\Repositories\DocumentOccurenceRepository;

class DocumentOccurenceService implements ServiceContract
{
    private $evidenceRepository;

    public function __construct(DocumentOccurenceRepository $evidenceRepository)
    {
        $this->evidenceRepository = $evidenceRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->evidenceRepository->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->evidenceRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->evidenceRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
        return $this->evidenceRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->evidenceRepository->delete($id);
    }
}
