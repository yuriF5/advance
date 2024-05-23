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

    public $messageContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification')
                    ->subject('Reseからのお知らせ')
                    ->with(['messageContent' => $this->messageContent]);
    }
}
