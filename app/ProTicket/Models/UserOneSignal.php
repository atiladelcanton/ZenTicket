<?php

namespace App\ProTicket\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model UserOneSignal
 * @version 1.0.0
 * @package App\ProTicket\Models
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
