<?php

namespace App\ProTicket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model ProjectUser
 * @version 1.0.0
 * @package App\ProTicket\Models
 */
class ProjectUser extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        "user_id", "project_id"

    ];


}
