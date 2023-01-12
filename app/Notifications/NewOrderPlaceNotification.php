<?php

namespace App\Notifications;

use App\Order;
use App\Mail\OrderPlaceMail;
use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderPlaceNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;
    public $message = '';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $url = "http://farmercart.in/get_order/".$order->order_id;
        $this->message = 'Thank you for shopping with us. Your order '.$order->order_id.' is successfully submitted, have a nice day.Check your order status here '.$url;
        $this->delay(now()->addSeconds(5));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsChannel::class];
    }

    public function toSms($notifiable)
    {

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = new OrderPlaceMail($notifiable, $this->order);
        $mail->to($notifiable->email);
        return $mail;
        // return (new MailMessage)
        //             ->subject('Order Place')
        //             ->greeting('Dear, '.$notifiable->name)
        //             ->line('Your order is placed')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
