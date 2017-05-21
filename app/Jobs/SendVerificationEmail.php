<?php

namespace App\Jobs;

use App\Mail\EmailVerification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $passwordReset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($passwordReset, $user)
    {
        $this->passwordReset = $passwordReset;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new EmailVerification($this->passwordReset);
        Mail::to($this->user->email)->send($email);

    }
}
