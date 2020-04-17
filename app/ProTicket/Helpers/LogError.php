<?php


namespace App\ProTicket\Helpers;


use Illuminate\Support\Facades\Log;

class LogError
{
    public static function Log($exception,$api=false){

        Log::error(
            [
                'causador' => uth()->user()->id,
                'origem' => 'USUARIO PAINEL',
                'linha' => $exception->getLine(),
                'arquivo' => $exception->getFile(),
                'erro' => $exception->getMessage(),
            ]
        );
    }
}