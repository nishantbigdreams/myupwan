<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    private $name, $email, $phone,$message, $emailfrom, $from_name, $emailto, $title;

    public function __construct($name,$emailto, $emailfrom, $from_name, $title, $phone, $message)
    {
        $this->name = $name;
        $this->email = $emailfrom;
        $this->emailfrom = $emailfrom;
        $this->from_name = $from_name;
        $this->emailto = $emailto;
        $this->title = $title;
        $this->phone = $phone;
        $this->message = $message;

    }

    public function build()
    {
        return $this->from($this->emailfrom, $this->from_name)
            ->Subject('Contact Us')
            ->view('emails.contactus')
            ->with(['name' => $this->name,'email' => $this->emailto,'phone' => $this->phone,'feedback' => $this->message,'title' => $this->title]);
    }
}
