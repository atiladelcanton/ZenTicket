<?php


    namespace App\ProTicket\Repositories;


    use App\ProTicket\Models\Document;

    /**
     * Class DocumentRepository
     * @package App\ProTicket\Repositories
     */
    class DocumentRepository extends EloquentRepository
    {
        public function __construct(Document $model)
        {
            parent::__construct($model);
        }
    }
