<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $comercio, $admin, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $comercio, $admin, $password)
    {
        $this->user = $user;
        $this->comercio = $comercio;
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->user->sexo == 1)
        return $this->markdown('emails.welcome_user')->subject('Bienvenida a '. $this->comercio .'!');
        else
        return $this->markdown('emails.welcome_user')->subject('Bienvenido a '. $this->comercio .'!');
    }
}
