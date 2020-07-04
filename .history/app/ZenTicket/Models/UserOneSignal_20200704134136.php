<?php

namespace App\ZenTicket\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model UserOneSignal
 * @version 1.0.0
 * @package App\ZenTicket\Models
 */
class UserOneSignal extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        "user_id",
        "device_id"
    ];
}
