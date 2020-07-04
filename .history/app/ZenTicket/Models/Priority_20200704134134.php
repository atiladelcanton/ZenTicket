<?php


namespace App\ZenTicket\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Priority
 * @package App\ZenTicket\Models
 */
class Priority extends Model
{
    protected $fillable = ['name', 'sla', 'color'];

    protected $casts = ['sla' => 'time'];
}
