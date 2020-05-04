<?php


    namespace App\ProTicket\Models;


    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Evidence
     * @package App\ProTicket\Models
     */
    class Evidence extends Model
    {

        protected $fillable = [
            'type',
            'ticket_id',
            'path'
        ];

        public function ticket()
        {
            return $this->belongsTo(Ticket::class, 'id');
        }
    }
