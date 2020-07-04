<?php


namespace App\ZenTicket\Services;


use Log;

class MailService
{
    /**
     * Send Mail with SendGrid
     *
     * @param string $viewTemplate
     * @param array $data
     * @param string $subject
     * @param string $fromEmail
     * @param string $fromName
     * @return void
     */
    public static function sendMailSendGrid(
        string $viewTemplate,
        array $data,
        string $subject,
        string $fromEmail,
        string $fromName
    ): void {
        Log::info($data);
        Mail::send($viewTemplate, $data, function (Message $message) use ($subject, $fromName, $fromEmail) {
            $message
                ->to($fromEmail, $fromName)
                ->from(env('EMAIL_TO'), env('NAME_TO'))
                ->subject($subject);
        });
    }
}
