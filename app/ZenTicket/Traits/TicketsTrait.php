<?php

namespace App\ZenTicket\Traits;

use App\ZenTicket\Scopes\TicketsScope;

trait TicketsTrait
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TicketsScope);
    }
}
