<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewContactMessage extends Notification
{
   use Queueable;
 protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
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
        $url = url('/backoffice/module/comments/'.$this->comment->id);


        return (new MailMessage)
        ->subject('A New Contact Message')
        ->greeting('Dear GAP Polymers Team!')
        ->line('A New contact message was sent by :'. $this->comment->fullname)
        ->action('Message', $url)
        ->line('Click above to check the message!');
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
        'Title' => "New Contact Message ". $this->comment->fullname,
        'route-name' => 'comments.show',
        'Id' => $this->comment->id 
        ];
        
    }
}
