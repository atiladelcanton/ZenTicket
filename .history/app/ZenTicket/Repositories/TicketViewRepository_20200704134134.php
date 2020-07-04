<?php


namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\ViewTicket;
use Schema;

/**
 * Class TicketViewRepository
 * @package App\ZenTicket\Repositories
 */
class TicketViewRepository extends EloquentRepository
{
    public function __construct(ViewTicket $model)
    {
        parent::__construct($model);
    }

    public function getByFilter(array $data)
    {
        $query = $this->model;
        if (isset($data['start']) && isset($data['end'])) {
            if (!is_null($data['start']) && !is_null($data['end'])) {
                $entry_de = date('Y-m-d', strtotime(str_replace('/', '-', $data['start'])));
                $entry_ate = date('Y-m-d', strtotime(str_replace('/', '-', $data['end'])));

                $query = $query->whereBetween('created_at', [$entry_de . " 00:00:00", $entry_ate . " 23:59:59"]);
            }
        }
        if (isset($data['full_search'])) {
            $columns = Schema::getColumnListing('vw_tickets');
            $not = ['id', 'created_at', 'updated_at', 'deleted_at'];

            $query = $query->where(function ($q) use ($columns, $not, $data) {


                foreach ($columns as $key => $column) {
                    if (in_array($column, $not) == false) {
                        $q->orWhere($column, 'ILIKE', '%' . $data['full_search'] . '%');
                    }
                }
            });
        }

        return $query->orderBy('id', 'desc')->paginate(15);
    }
}
