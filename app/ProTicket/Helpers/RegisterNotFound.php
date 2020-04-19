<?php


namespace App\ProTicket\Helpers;


use Illuminate\Http\RedirectResponse;

class RegisterNotFound
{

    /**
     * @param $service
     * @param $reference
     * @return bool
     */
    public static function validate($service, $reference)
    {
        $return = $service->renderEdit($reference);

        if (is_null($return)) {
            return false;
        }
        return true;
    }
}