<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaiementValider extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
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
        $subject = sprintf('%s:Merci de donner votre avis a notre services %s', config('app.name'), '');
        $greeting = sprintf('Bonjour %s', $notifiable->name);
        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line('Voici Votre numéro de réservation ' . $notifiable->id_reservation)
            ->line('Merci de donner votre feedback à nos chauffeurs, offre; service ..., pour pouvoir le améliorer pour vous.')
            ->action('Donne un feedback', url("/avis/$notifiable->id" . "/" . $notifiable->offreDetail->id))
            ->line('Merci pour votre confiance');
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
