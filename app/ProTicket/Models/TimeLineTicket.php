<?php


namespace App\ProTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeLineTicket
 * @package App\ProTicket\Models
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
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id');
    }
}
