<?php

namespace App\Jobs\Auth;

use App\Mail\Auth\EmailToResetPassword;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailToResetPassword implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly User $user,
        public readonly string $time,
        public readonly string $token
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $email = new EmailToResetPassword(
            $this->user->name,
            $this->user->email,
            $this->time,
            $this->token
        );
        Mail::to($this->user)->send($email);
    }
}
