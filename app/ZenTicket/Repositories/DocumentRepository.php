<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\Document;

/**
 * Class DocumentRepository
 * @package App\ZenTicket\Repositories
 */
class DocumentRepository extends EloquentRepository
{
    public function __construct(Document $model)
    {
        parent::__construct($model);
    }
}
