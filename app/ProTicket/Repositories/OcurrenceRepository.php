<?php


    namespace App\ProTicket\Repositories;


    use App\ProTicket\Models\Ocurrence;

    /**
     * Class OcurrenceRepository
     * @package App\ProTicket\Repositories
     */
    class OcurrenceRepository extends EloquentRepository
    {
        public function __construct(Ocurrence $model)
        {
            parent::__construct($model);
        }
    }
