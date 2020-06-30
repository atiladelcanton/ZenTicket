<?php

namespace App\ProTicket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Project
 * @version 1.0.0
 * @package App\ProTicket\Models
 */
class Project extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        "name",
        "logo",
        "responsible_name",
        "responsible_email",
        "hash_identify"
    ];

    protected $with = ['usersProject'];

    public function usersProject()
    {
        return $this->hasMany(ProjectUser::class, 'project_id', 'id');
    }
}
