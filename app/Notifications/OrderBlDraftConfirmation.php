<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderBlDraftConfirmation extends Notification
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
        ->subject('Order BL Draft Confirmation Required')
        ->greeting('Dear Customer!')
        ->line('Please Confirm the BL Draft of your order.')
        ->action('Order', $url)
        ->line('Click above to confirm the BL Draft!');
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
        'Title' => "Bl Draft Confirmation",
        'route-name' => 'orders.show',
        'Id' => $this->order->id 
        ];
        else
            return [
        'Title' => "Bl Draft Confirmation",
        'route-name' => 'myorders.show',
        'Id' => $this->order->id 
        ];
    }
}
