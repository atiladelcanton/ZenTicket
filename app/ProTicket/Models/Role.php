<?php

namespace App\ProTicket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Model Role
 * @author Atila Rampazo <atilarampazo@gmail.com>
 * @version 1.0.0
 * @package App\ProTicket\Models
 */
class Role extends Model
{
    protected $fillable = [
        'type',
        'name'
    ];
    protected $with = ['permissions'];

    /**
     * Many-to-many permission-user relationship.
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(
            config('defender.permission_model'),
            config('defender.permission_role_table'),
            'role_id',
            config('defender.permission_key')
        )->withPivot('value', 'expires');
    }

}
