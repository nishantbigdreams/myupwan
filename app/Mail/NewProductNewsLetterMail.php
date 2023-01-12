<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProductNewsLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, $data)
    {
        $this->product = $product;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_product_newsletter')
                    ->subject('Product you might want to check');
    }
}
