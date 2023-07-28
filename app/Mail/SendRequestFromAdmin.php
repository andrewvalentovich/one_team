<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendRequestFromAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @param  array  $mailData
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.request')
            ->with([
                'phone' => $this->details['phone']??null,
                'country' => $this->details['country']??null,
                'fio' => $this->details['fio']??null,
                'product_id' => $this->details['product_id']??null,
                'messanger' => $this->details['messanger']??null,
            ])
            ->subject('Новая Заявка');
    }
}
