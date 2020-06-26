<?php


    namespace App\ProTicket\Services;


    use App\ProTicket\Contracts\ServiceContract;
    use App\ProTicket\Repositories\OcurrenceRepository;


    class OcurrenceService implements ServiceContract
    {
        private $ocurrenceRepository;

        public function __construct(OcurrenceRepository $ocurrenceRepository)
        {
            $this->ocurrenceRepository = $ocurrenceRepository;
        }


        /**
         * @inheritDoc
         */
        public function renderList(string $column = 'id', $orderColum = 'DESC')
        {
            return $this->ocurrenceRepository->getAll($column, $orderColum);
        }

        /**
         * @inheritDoc
         */
        public function renderEdit(int $id)
        {
            return $this->ocurrenceRepository->getById($id);
        }

        /**
         * @inheritDoc
         */
        public function buildUpdate(int $id, array $data)
        {
            return $this->ocurrenceRepository->update($id, $data);
        }

        /**
         * @inheritDoc
         */
        public function buildInsert(array $data)
        {
            return $this->ocurrenceRepository->create($data);
        }

        /**
         * @inheritDoc
         */
        public function buildDelete(int $id)
        {
            return $this->ocurrenceRepository->delete($id);
        }
    }
