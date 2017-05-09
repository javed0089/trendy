<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewRegistration extends Notification
{
 use Queueable;
 protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $url = url('/backoffice/customers/customers/'.$this->user->id);


        return (new MailMessage)
        ->subject('A New Registration Online')
        ->greeting('Dear GAP Polymers Team!')
        ->line('A New user registered :'. $this->user->first_name ." ". $this->user->last_name.",")
        ->action('Customer', $url)
        ->line('Click above to check the User!');
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
        'Title' => "New Registration". $this->user->first_name ." ". $this->user->last_name.",",
        'route-name' => 'customers.show',
        'Id' => $this->user->id 
        ];
        
    }
}
