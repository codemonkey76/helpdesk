<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class MessageReceivedNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $data;

    /**
     * MessageReceivedNotification constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have received a new message from ' . $this->data->fromUser)
                    ->line('<strong>Message Body</strong><br>')
                    ->line('<p>')
                    ->line($this->data->body)
                    ->line('</p><br>')
                    ->action('Go to messages', url('/messages'))
                    ->line('Thank you for using our application!');
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
            'id' => $this->data->id,
            'body' => $this->data->body,
            'fromUser' => $this->data->fromUser,
            'toUser' => $this->data->toUser
            ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => $this->data
        ]);
    }
}
