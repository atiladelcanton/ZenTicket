<?php

namespace App\ZenTicket\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ProjectUser
 * @version 1.0.0
 * @package App\ZenTicket\Models
 */
class ProjectUser extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        "user_id",
        "project_id"
    ];
}
