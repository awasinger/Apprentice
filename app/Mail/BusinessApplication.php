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
    public $name;
    public $desc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $name,$desc)
    {
        $this->user = $user;
        $this->name = $name;
        $this->desc = $desc;
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
