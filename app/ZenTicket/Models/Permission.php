<?php

namespace App\ZenTicket\Models;

use Artesaos\Defender\Pivots\PermissionRolePivot;
use Artesaos\Defender\Pivots\PermissionUserPivot;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Permissions
 * @version 1.0.0
 * @package App\ZenTicket\Models
 */
class Permission extends Model implements \Artesaos\Defender\Contracts\Permission
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {

        $this->fillable = $fillable = [
            'name',
            'readable_name',
            'modules_id',
        ];

        parent::__construct($attributes);

        $this->table = config('defender.permission_table', 'permissions');
    }

    /**
     * Many-to-many permission-role relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            config('defender.role_model'),
            config('defender.permission_role_table'),
            config('defender.permission_key'),
            config('defender.role_key')
        )->withPivot('value', 'expires');
    }

    /**
     * Many-to-many permission-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            config('defender.user_model'),
            config('defender.permission_user_table'),
            config('defender.permission_key'),
            'user_id'
        )->withPivot('value', 'expires');
    }
}
