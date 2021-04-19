<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $details
     */
    public function __construct($details)
    {
        $this->data = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->data['email'])
            ->subject('Equatorial Nut Buyer Registration Successful')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'))
            ->markdown('emails.buyer-created');
    }
}
