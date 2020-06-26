<?php


namespace App\ProTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Ocurrence
 * @package App\ProTicket\Models
 */
class Ocurrence extends Model
{

    protected $fillable = [
        'ticket_id',
        'description',
        'user_id'
    ];
    protected $with = [
        'documents',
        'ticket'
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id');
    }

    public function documents()
    {
        return $this->hasMany(DocumentOccurence::class, 'occurences_id', 'id');
    }
}
