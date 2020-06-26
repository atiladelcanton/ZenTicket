<?php


namespace App\ProTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\ProTicket\Models
 */
class DocumentOccurence extends Model
{

    protected $fillable = [
        'type',
        'occurences_id',
        'extension_document',
        'name'
    ];
    protected $with = [
        'occurence'
    ];
    public function occurence()
    {
        return $this->belongsTo(Ocurrence::class, 'id');
    }
}
