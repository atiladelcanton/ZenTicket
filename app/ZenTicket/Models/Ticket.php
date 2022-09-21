<?php


namespace App\ZenTicket\Models;

use App\ZenTicket\Traits\TicketsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App\ZenTicket\Models
 */
class Ticket extends Model
{
    use TicketsTrait;

    const COD_STATUS_E = 'E';
    const COD_STATUS_T = 'T';
    const COD_STATUS_C = 'C';
    const COD_STATUS_P = 'P';

    const DESC_STATUS_E = 'Em Espera';
    const DESC_STATUS_T = 'Em Tratamento';
    const DESC_STATUS_C = 'Concluído';
    const DESC_STATUS_P = 'Pausado';

    protected $fillable = [
        'type_id',
        'project_id',
        'user_open_ticket',
        'priority_id',
        'role_id',
        'impact_id',
        'status',
        'responsible_ticket',
        'ticket_number',
        'title',
        'description'
    ];

    protected $with = [
        'type',
        'project',
        'userOpen',
        'priority',
        'impact',
        'documents',
        'userResponsible',
        'timeLineTicket',
        'ocurrences'
    ];

    public function type()
    {
        return $this->hasOne(TypeTicket::class, 'id', 'type_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function userOpen()
    {
        return $this->hasOne(User::class, 'id', 'user_open_ticket');
    }

    public function userResponsible()
    {
        return $this->hasOne(User::class, 'id', 'responsible_ticket');
    }

    public function priority()
    {
        return $this->hasOne(Priority::class, 'id', 'priority_id');
    }

    public function impact()
    {
        return $this->hasOne(Impact::class, 'id', 'impact_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'ticket_id');
    }

    public function ocurrences()
    {
        return $this->hasMany(Ocurrence::class, 'ticket_id');
    }

    public function timeLineTicket()
    {
        return $this->hasMany(TimeLineTicket::class, 'ticket_id');
    }

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case self::COD_STATUS_E:
                return self::DESC_STATUS_E;
            case self::COD_STATUS_T:
                return self::DESC_STATUS_T;
            case self::COD_STATUS_P:
                return self::DESC_STATUS_P;
            default:
                return self::DESC_STATUS_C;
        }
    }
}
