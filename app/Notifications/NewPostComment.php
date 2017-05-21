<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPostComment extends Notification
{
 use Queueable;
 protected $postComment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($postComment)
    {
        $this->postComment = $postComment;
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
        $url = url('/backoffice/blog/posts/'.$this->postComment->post_id);


        return (new MailMessage)
        ->subject('A New Blog Post Comment')
        ->greeting('Dear GAP Polymers Team!')
        ->line('A New blog post comment was made by :'. $this->postComment->name)
        ->action('Blog Post', $url)
        ->line('Click above to check the comment!');
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
        'Title' => "New Blog Post Comment ". $this->postComment->name,
        'route-name' => 'posts.show',
        'Id' => $this->postComment->post_id 
        ];
        
    }
}
