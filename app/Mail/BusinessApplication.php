<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessApplication extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $desc;
    public $token;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $desc, $token)
    {
        $this->user = $user;
        $this->desc = $desc;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.businessApplication');
    }
}
