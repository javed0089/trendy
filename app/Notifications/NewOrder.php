<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrder extends Notification
{
    use Queueable;
    protected $order;
    protected $userType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order,$userType)
    {
        $this->order = $order;
        $this->userType = $userType;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->userType == "backend")
            $url = url('/backoffice/orders/'.$this->order->id);
        else
            $url = url('/myaccount/myorders/'.$this->order->id);

        return (new MailMessage)
        ->subject('A New Order Online')
        ->greeting('Dear GAP Polymer Team!')
        ->line('A New order was created by '. $this->order->User->first_name ." ". $this->order->User->last_name.",")
        ->action('Order', $url)
        ->line('Click above to check the Order!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if($this->userType == "backend")
            return [
        'Title' => "New Order". $this->order->User->first_name ." ". $this->order->User->last_name.",",
        'route-name' => 'orders.show',
        'Id' => $this->order->id 
        ];
        else
            return [
        'Title' => "PI Confirmed". $this->order->User->first_name ." ". $this->order->User->last_name.",",
        'route-name' => 'myorders.show',
        'Id' => $this->order->id 
        ];
    }
}
