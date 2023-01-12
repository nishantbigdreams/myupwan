<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($body)
    {
        $this->body = urlencode($body);
        $this->delay(now()->addSeconds(5));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (User::all() as $key => $user) {
            sendMessage($user->phone, $this->body);
        }
    }
}
