<?php


namespace App\ZenTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\ZenTicket\Models
 */
class DocumentOccurrence extends Model
{

    protected $fillable = [
        'occurences_id',
        'extension_document',
        'name'
    ];
}
