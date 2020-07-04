<?php


namespace App\ZenTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeTickets
 * @package App\ZenTicket\Models
 */
class TypeTicket extends Model
{
    protected $fillable = ['name', 'icon', 'color'];
}
