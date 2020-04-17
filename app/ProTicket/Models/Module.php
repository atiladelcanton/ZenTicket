<?php

namespace App\ProTicket\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Module
 * @version 1.0.0
 * @package App\ProTicket\Models
 */
class Module extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        "name", "slug", "icon","parent_id"
    ];
    protected $with = ['permissions','parents'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'modules_id', 'id');
    }
    public function parents(){
        return $this->hasMany(Module::class,'parent_id','id');
    }
}
