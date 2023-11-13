<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class checkoutNotification extends Notification
{
    use Queueable;

    public $orderno;
    public $items;

    /**
     * Create a new notification instance.
     */
    public function __construct($orderNo,$temp)
    {
        //
        $this->orderno = $orderNo;
        $this->items = $temp;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('message from ecom websiite')
                    ->line('you have successfully ordered')
                    ->line('your order no is :'.$this->orderno)
                    ->line('you have ordered '.$this->items)
                    ->line('thank you for using app');
        // $mail = new MailMessage();
        // return $mail->markdown('mail.checkoutMail',[
        //     'orderno'=>$this->orderno,
        //     'title'=>$this->items
        // ])
        // ->subject('mail from webapp');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
