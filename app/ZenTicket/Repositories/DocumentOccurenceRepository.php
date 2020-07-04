<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\DocumentOccurrence;

/**
 * Class DocumentRepository
 * @package App\ZenTicket\Repositories
 */
class DocumentOccurenceRepository extends EloquentRepository
{
    public function __construct(DocumentOccurrence $model)
    {
        parent::__construct($model);
    }
}
