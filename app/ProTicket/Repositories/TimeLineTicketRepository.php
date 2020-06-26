<?php


    namespace App\ProTicket\Repositories;


    use App\ProTicket\Models\TimeLineTicket;

    /**
     * Class TimeLineTicketRepository
     * @package App\ProTicket\Repositories
     */
    class TimeLineTicketRepository extends EloquentRepository
    {
        public function __construct(TimeLineTicket $model)
        {
            parent::__construct($model);
        }
    }
