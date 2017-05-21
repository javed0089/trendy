<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewJobApplication extends Notification
{
 use Queueable;
 protected $jobApplication;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($jobApplication)
    {
        $this->jobApplication = $jobApplication;
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
        $url = url('/backoffice/module/jobs/'.$this->jobApplication->job_id);


        return (new MailMessage)
        ->subject('A New Job Application')
        ->greeting('Dear GAP Polymers Team!')
        ->line('A New job application was send by :'. $this->jobApplication->applicant_name)
        ->action('Message', $url)
        ->line('Click above to check the applicaiton!');
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
        'Title' => "New Job Application ". $this->jobApplication->applicant_name,
        'route-name' => 'jobs.show',
        'Id' => $this->jobApplication->job_id 
        ];
        
    }
}
