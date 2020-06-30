<?php


namespace App\ProTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\ProTicket\Models
 */
class DocumentOccurrence extends Model
{

    protected $fillable = [
        'occurences_id',
        'extension_document',
        'name'
    ];
}
