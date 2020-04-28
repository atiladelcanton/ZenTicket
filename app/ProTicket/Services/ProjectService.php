<?php


    namespace App\ProTicket\Services;


    use App\ProTicket\Contracts\ServiceContract;
    use App\ProTicket\Helpers\Upload;
    use App\ProTicket\Repositories\ProjectRepository;
    use Exception;
    use Ramsey\Uuid\Uuid;

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
         * @throws Exception
         */
        public function buildUpdate(int $id, array $data)
        {
            if (isset($data['logo'])) {
                $project = $this->projectRepository->getById($id);
                $data['logo'] = $this->executeUpload($data, $project->hash_identify);
            }
            return $this->projectRepository->update($id, $data);
        }

        /**
         * @param $data
         * @param $hash
         * @return string
         * @throws Exception
         */
        private function executeUpload($data, $hash)
        {
            if (isset($data['logo'])) {
                return Upload::uploadFile('image', 'projects/' . $hash, $data['logo']);
            }
        }

        /**
         * @inheritDoc
         * @throws Exception
         */
        public function buildInsert(array $data)
        {
            $data['hash_identify'] = Uuid::uuid1()->toString();
            $data['logo'] = $this->executeUpload($data, $data['hash_identify']);
            return $this->projectRepository->create($data);
        }

        /**
         * @inheritDoc
         */
        public function buildDelete(int $id)
        {
            $project = $this->projectRepository->getById($id);

            if ($project->logo) {
                unlink(public_path($project->logo));
            }
            return $this->projectRepository->delete($id);
        }
    }
