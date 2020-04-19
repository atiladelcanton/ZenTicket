<?php


namespace App\ProTicket\Repositories;


use App\ProTicket\Models\TypeTicket;

/**
 * Class TypeTicketsRepository
 * @package App\ProTicket\Repositories
 */
class TypeTicketRepository extends EloquentRepository
{
    public function __construct(TypeTicket $model)
    {
        parent::__construct($model);
    }
}