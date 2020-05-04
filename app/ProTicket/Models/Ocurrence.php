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
            'description'
        ];

        public function ticket()
        {
            return $this->belongsTo(Ticket::class, 'id');
        }
    }
