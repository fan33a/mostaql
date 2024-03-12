<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProposal extends Notification
{
    use Queueable;

    protected $msg;
    protected $url;
    /**
     * Create a new notification instance.
     */
    public function __construct($msg, $url)
    {
        $this->msg = $msg;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // explode() return array every word in single index
        // example: 'mail,database' => ['mail', 'database'] 
        $via = explode(',', $notifiable->channel_type);
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('There is new proposal submitted to your project')
                    ->action('Project\'s Admin', url('/'))
                    ->line('Thank you for using our application!');
    }

    // // Database notify
    // public function toDatabase($notifiable) {
    //     return [
    //         'msg' => $this->msg,
    //         'url' => $this->url
    //     ];
    // }

    // // Broadcast notify
    // public function toBroadcast($notifiable) {
    //     return [
    //         'msg' => $this->msg,
    //         'url' => $this->url
    //     ];
    // }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'msg' => $this->msg,
            'url' => $this->url
        ];
    }
}
