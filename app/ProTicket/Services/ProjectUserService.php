<?php


    namespace App\ProTicket\Services;

    use App\ProTicket\Contracts\ServiceContract;
    use App\ProTicket\Repositories\projectUserRepository;

    class ProjectUserService implements ServiceContract
    {
        private $projectUserRepository;

        public function __construct(projectUserRepository $projectUserRepository)
        {
            $this->projectUserRepository = $projectUserRepository;
        }


        /**
         * @inheritDoc
         */
        public function renderList(string $column = 'id', $orderColum = 'DESC')
        {
            return $this->projectUserRepository->getAll($column, $orderColum);
        }

        /**
         * @inheritDoc
         */
        public function renderEdit(int $id)
        {
            return $this->projectUserRepository->getById($id);
        }

        /**
         * @inheritDoc
         */
        public function buildUpdate(int $id, array $data)
        {
            return $this->projectUserRepository->update($id, $data);
        }

        /**
         * @inheritDoc
         */
        public function buildInsert(array $data)
        {
            return $this->projectUserRepository->create($data);
        }

        /**
         * @inheritDoc
         */
        public function buildDelete(int $id)
        {
            return $this->projectUserRepository->delete($id);
        }
    }
