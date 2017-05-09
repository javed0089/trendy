<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuoteAssigned extends Notification
{
    use Queueable;
    protected $quote;
    protected $userType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quote,$userType)
    {
        $this->quote = $quote;
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
            $url = url('/backoffice/quotes/quote-requests/'.$this->quote->id);
        else
            $url = url('/myaccount/quotes/'.$this->quote->id);

        return (new MailMessage)
        ->subject('A Quote Request is Assigned')
        ->greeting('Hello Dear!')
        ->line('A Quotation Request is assigned to you, your prompt action will be appreciated.')
        ->action('Quote Request', $url)
        ->line('Click above to check your Assignment!');
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
        'Title' => "Quote request assigned",
        'route-name' => 'quote-requests.show',
        'Id' => $this->quote->id 
        ];
        else
            return [
        'Title' => "Quote request assigned",
        'route-name' => 'quotes.show',
        'Id' => $this->quote->id 
        ];
    }
}
