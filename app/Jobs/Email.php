<?php

namespace App\Jobs;

use App\User;
use App\Jobs\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    public $user_email;

    public $data;

    public $subject;

    public $template;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct($template,$data,$user_email,$subject)
    {
        $this->template = $template;
        $this->data = $data;
        $this->user_email = $user_email;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $template = $this->template;
        $data = $this->data;
        $user_email = $this->user_email;
        $subject = $this->subject;
        $mailer->send($template, $data, function ($message) use ($user_email, $subject) {
            $message->to($user_email)->subject($subject);
        });
    }
}
