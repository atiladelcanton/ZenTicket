<?php


    namespace App\ProTicket\Services;


    use App\ProTicket\Contracts\ServiceContract;
    use App\ProTicket\Repositories\ProjectRepository;

    class ProjectService implements ServiceContract
    {
        private $projectRepository;

        public function __construct(ProjectRepository $projectRepository)
        {
            $this->projectRepository = $projectRepository;
        }


        /**
         * @inheritDoc
         */
        public function renderList(string $column = 'id', $orderColum = 'DESC')
        {
            return $this->projectRepository->getAll($column, $orderColum);
        }

        /**
         * @inheritDoc
         */
        public function renderEdit(int $id)
        {
            return $this->projectRepository->getById($id);
        }

        /**
         * @inheritDoc
         */
        public function buildUpdate(int $id, array $data)
        {
            return $this->projectRepository->update($id, $data);
        }

        /**
         * @inheritDoc
         */
        public function buildInsert(array $data)
        {
            return $this->projectRepository->create($data);
        }

        /**
         * @inheritDoc
         */
        public function buildDelete(int $id)
        {
            return $this->projectRepository->delete($id);
        }
    }
