<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuoteRequest extends Notification
{
    use Queueable;
    protected $quote;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quote)
    {
        $this->quote=$quote;
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
        $url = url('/backoffice/quotes/quote-requests/'.$this->quote->id);
        return (new MailMessage)
                    ->subject('New Quote Request')
                    ->greeting('Hello!')
                    ->line('A new quote request was made by '. $this->quote->User->first_name ." ". $this->quote->User->last_name.",")
                    ->action('Quote Request', $url)
                    ->line('You can click the above link to check the quote!');
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
            'Title' => "New quote request by ".$this->quote->User->first_name ." ". $this->quote->User->last_name,
            'route-name' => 'quote-requests.show',
            'Id' => $this->quote->id 
        ];
    }
}
