<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

   public $url;
   public $name;

    public function __construct($user)
    {
        $app_web_url = env('APP_WEB_URL');
        $this->url = url('/api/auth/signup/activate/'.$user->activation_token);
        $this->name = $user->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Sistema de facturación - Correo de verificación')
        ->view('email.confirmation');
    }
}
