<?php


namespace App\ZenTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Ocurrence
 * @package App\ZenTicket\Models
 */
class Ocurrence extends Model
{

    protected $fillable = [
        'ticket_id',
        'description',
        'user_id'
    ];
    protected $with = [
        'documentsOccurences',
    ];

    public function documentsOccurences()
    {
        return $this->hasMany(DocumentOccurrence::class, 'occurences_id', 'id');
    }
}
