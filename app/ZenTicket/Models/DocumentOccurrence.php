<?php


namespace App\ZenTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\ZenTicket\Models
 */
class DocumentOccurrence extends Model
{
    protected $table = 'document_occurrences';
    protected $fillable = [
        'occurrence_id',
        'extension_document',
        'name'
    ];
}
