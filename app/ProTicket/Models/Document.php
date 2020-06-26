<?php


    namespace App\ProTicket\Models;


    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Document
     * @package App\ProTicket\Models
     */
    class Document extends Model
    {

        protected $fillable = [
            'type',
            'ticket_id',
            'extension_document',
            'name'
        ];

        public function ticket()
        {
            return $this->belongsTo(Ticket::class, 'id');
        }
    }
