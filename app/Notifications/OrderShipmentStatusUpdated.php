<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderShipmentStatusUpdated extends Notification
{
    use Queueable;
    protected $order;
    protected $userType;
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order,$userType,$status)
    {
        $this->order = $order;
        $this->userType = $userType;
        $this->status = $status;
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
        ->subject('Order Shipment Status Updated')
        ->greeting('Hope you are doing well!')
        ->line('Shipment status of your Order updated to '. $this->status)
        ->action('Order', $url)
        ->line('Click above to check your Order STATUS!');
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
        'Title' => "Order shipment status ". $this->status,
        'route-name' => 'orders.show',
        'Id' => $this->order->id 
        ];
        else
            return [
        'Title' => "Order shipment status ". $this->status,
        'route-name' => 'myorders.show',
        'Id' => $this->order->id 
        ];
    }
}
