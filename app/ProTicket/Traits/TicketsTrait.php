<?php

namespace App\ProTicket\Traits;

use App\ProTicket\Scopes\TicketsScope;

trait TicketsTrait
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TicketsScope);
    }
}
