<?php


namespace App\ProTicket\Repositories;


use App\ProTicket\Models\DocumentOccurrence;

/**
 * Class DocumentRepository
 * @package App\ProTicket\Repositories
 */
class DocumentOccurenceRepository extends EloquentRepository
{
    public function __construct(DocumentOccurrence $model)
    {
        parent::__construct($model);
    }
}
