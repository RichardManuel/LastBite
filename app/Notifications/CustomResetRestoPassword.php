<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetRestoPassword extends Notification
{
    use Queueable;


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }
    public function toMail(object $notifiable): MailMessage
    {
        $resetUrl = route('resto.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        // ganti url importan!!!!
        return (new MailMessage)
            ->subject('Reset Password - LastBite')
            ->greeting('Hello ' . $notifiable->name . ' 👋')
            ->line('We received a request to reset your password.')
            ->action('Reset Password', $resetUrl)
            ->line('If you didn’t request this, no further action is required.')
            ->salutation('Stay healthy, LastBite Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
