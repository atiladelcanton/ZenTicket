<?php


namespace App\ProTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeTickets
 * @package App\ProTicket\Models
 */
class TypeTicket extends Model
{
    protected $fillable = ['name', 'icon'];
}