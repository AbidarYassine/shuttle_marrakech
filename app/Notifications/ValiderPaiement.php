<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValiderPaiement extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('%s:Merci de valider le paiement %s', config('app.name'), '');
        $greeting = sprintf('Bonjour %s', $notifiable->name);
        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line('Merci de valider votre reservation,un de nous chauffeur sera à votre disposition plus rapidement possible')
            ->line('Le prix ' . $notifiable->prix)
            ->action('Valider', url("/paiement/$notifiable->id" . "/" . $notifiable->offreDetail->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
