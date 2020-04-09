<?php

namespace App;

use App\Notifications\MailResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime'
    ];

    /**
     * Many-to-many role-user relationship.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $roleModel = config('defender.role_model', 'Artesaos\Defender\Role');
        $roleUserTable = config('defender.role_user_table', 'role_user');
        $roleKey = config('defender.role_key', 'role_id');

        return $this->belongsToMany($roleModel, $roleUserTable,
            'administrator_id', $roleKey);
    }

    /**
     * Many-to-many permission-user relationship.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('defender.permission_model'),
            config('defender.permission_user_table'),
            'administrator_id',
            config('defender.permission_key')
        )->withPivot('value', 'expires');
    }
}
