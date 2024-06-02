<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use Illuminate\Support\Facades\URL;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class ReservationReminder  extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $signedUrl = URL::signedRoute('reservation.confirm',['reservation' => $this->reservation->id]);
        $qrCode = QrCode::size(200)->generate($signedUrl);
        return $this->subject('予約リマインダー')
            ->view('emails.reminder')
            ->with([
                'qrCode' => $qrCode,
                'reservation' => $this->reservation
            ]);
    }
}
