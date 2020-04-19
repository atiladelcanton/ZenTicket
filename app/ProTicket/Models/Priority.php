<?php


namespace App\ProTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Priority
 * @package App\ProTicket\Models
 */
class Priority extends Model
{
    protected $fillable = ['name', 'sla'];

    protected $casts = ['sla' => 'time'];
}