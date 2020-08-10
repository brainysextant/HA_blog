<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    // Docs: https://laravel.com/docs/master/mail

    use Queueable, SerializesModels;

    private $contactName;
    private $contactEmail;
    private $contactMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactName, $contactEmail, $contactMessage)
    {
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Formulario de Contacto")
            ->from('hack.academy.test@gmail.com', 'Automotora VIP')
            ->view('emails.contact')->with([
                'contactName' => $this->contactName,
                'contactEmail' => $this->contactEmail,
                'contactMessage' => $this->contactMessage,
            ]);
    }
}
