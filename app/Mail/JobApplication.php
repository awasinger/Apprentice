<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobApplication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($apply, $name, $course, $score, $email)
    {
        $this->apply = $apply;
        $this->name = $name;
        $this->course = $course;
        $this->score = $score;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.jobApplication')->with([
            'app' => $this->apply,
            'name' => $this->name,
            'course' => $this->course,
            'score' => $this->score,
            'email' => $this->email,
        ]);
    }
}
