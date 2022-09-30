<?php


namespace App\ZenTicket\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeLineTicket
 * @package App\ZenTicket\Models
 */
class TimeLineTicket extends Model
{

    protected $fillable = [
        'ticket_id',
        'start',
        'stop'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'start' => 'datetime:Y-m-d',
        'stop' => 'datetime:Y-m-d',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
