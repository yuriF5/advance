<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public function __construct($user, $messageContent)
    {
        $this->user = $user;
        $this->messageContent = str_replace("\n"," \n",$messageContent);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reseからのお知らせ')->markdown('emails.notification')
            ->with(['messageContent' => $this->messageContent,]);
    }
}
