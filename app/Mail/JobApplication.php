<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class JobApplication extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $apply;
    public $course;
    public $score;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $apply, $course, $score)
    {
        $this->user = $user;
        $this->apply = $apply;
        $this->course = $course;
        $this->score = $score;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.jobApplication');
    }
}
/*->with([
            'app' => $this->apply,
            'name' => $this->name,
            'course' => $this->course,
            'score' => $this->score,
            'email' => $this->email,
        ]*/