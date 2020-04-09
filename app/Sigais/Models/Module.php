<?php

namespace App\Sigais\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Module
 * @version 1.0.0
 * @package App\Sigais\Models
 */
class Module extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        "name", "slug", "icon",
    ];
    protected $with = ['permissions'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'modules_id', 'id');
    }
}
