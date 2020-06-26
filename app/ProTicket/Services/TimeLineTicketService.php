<?php


    namespace App\ProTicket\Services;

    use App\ProTicket\Contracts\ServiceContract;
    use App\ProTicket\Repositories\TimeLineTicketRepository;

    class TimeLineTicketService implements ServiceContract
    {
        private $timelineTicketRepository;

        public function __construct(TimeLineTicketRepository $timelineTicketRepository)
        {
            $this->timelineTicketRepository = $timelineTicketRepository;
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
    }
