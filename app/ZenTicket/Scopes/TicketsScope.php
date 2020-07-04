<?php

namespace App\ZenTicket\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TicketsScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

        if (auth()->check() && auth()->user()->roles[0]->id != 1) {
            if (!is_null(auth()->user()->projectsUser)) {
                $builder->whereIn('project_id', auth()->user()->projectsUser->pluck('project_id')->toArray());
            }
        }
    }
}
