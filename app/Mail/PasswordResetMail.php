<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $url; 
    public $name; 

    public function __construct($token,$name)
    {
        $app_web_url = env('APP_WEB_URL');
        $this->url = $app_web_url.'/auth/reset-password/'.$token;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Sistema de facturación - Resetear contraseña')
        ->view('email.reset');
    }
}
