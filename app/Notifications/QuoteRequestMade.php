<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuoteRequestMade extends Notification
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
        return ['database'];
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
                    ->subject('New Quote Request created')
                    ->greeting('Hello!')
                    ->line('A new quote Request was made.')
                    ->action('Quote Request', $url)
                    ->line('You can click the above link to check the quote!');

        //Custom view email
       /* return (new MailMessage)->view('frontend.emails.quotetest', ['quote' => $this->quote]);*/
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
            'Title' => "New quote request made",
            'Id' => $this->quote->id 
        ];
    }
}
