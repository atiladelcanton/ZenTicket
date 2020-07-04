<?php


namespace App\ZenTicket\Helpers;


class SessionFlashMessage
{
    const UPDATE = 'update';
    const STORE = 'store';
    const EDIT = 'edit';
    const DESTROY = 'delete';

    /**
     * Create Session Flash Success
     * @param string $type
     */
    public static function success(string $type): void
    {
        if ($type === self::UPDATE) {
            $msg = __('messages.success_update');
        } elseif ($type === self::STORE) {
            $msg = __('messages.success_store');
        } else {
            $msg = __('messages.success_destroy');
        }
        self::sessionFlash('Success', $msg);
    }

    private static function sessionFlash(string $type, string $msg): void
    {
        session()->flash('message', ['type' => $type, 'msg' => $msg]);
    }

    /**
     * Create Session Flash Message Error
     * @param string $type
     */
    public static function error(string $type): void
    {
        if ($type === self::UPDATE) {
            $msg = __('messages.catch_message_update');
        } elseif ($type === self::EDIT) {
            $msg = __('messages.catch_message_edit');
        } else {
            $msg = __('messages.catch_message_store');
        }

        self::sessionFlash('Error', $msg);
    }
}
