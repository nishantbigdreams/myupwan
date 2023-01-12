<?php

namespace App\Jobs;

use Mail;
use App\User;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewProductNewsLetterMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class sendNewProductNewsLetter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->delay(now()->addSeconds(1));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (User::where('subcribe_to_newsletter', 'yes')->get() as $key => $user) {
            $data['email'] = $user->email;
            $data['user_id_hash'] = urlencode(bcrypt($user->id));
            // $data['user_email_hash'] = bcrypt($user->email);
            Mail::to($user)->send(new NewProductNewsLetterMail($this->product, $data));   
        }
    }
}
