<?php


namespace App\ZenTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\ZenTicket\Models
 */
class Document extends Model
{

    protected $fillable = [
        'ticket_id',
        'extension_document',
        'name'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
