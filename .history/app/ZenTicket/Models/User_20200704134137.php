<?php

namespace App\ZenTicket\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Artesaos\Defender\Traits\HasDefender;

/**
 * Model User
 * @author Atila Rampazo <atilarampazo@gmail.com>
 * @version 1.0.0
 * @package App\ZenTicket\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use  Notifiable, HasDefender;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['roles', 'projectsUser'];
    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $roleModel = config('defender.role_model', 'Artesaos\Defender\Role');
        $roleUserTable = config('defender.role_user_table', 'role_user');
        $roleKey = config('defender.role_key', 'role_id');

        return $this->belongsToMany(
            $roleModel,
            $roleUserTable,
            'user_id',
            $roleKey
        );
    }

    /**
     * Many-to-many permission-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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

    public function projectsUser()
    {
        return $this->hasMany(ProjectUser::class, 'user_id');
    }
}
