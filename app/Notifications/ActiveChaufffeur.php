<?php

namespace App\Notifications;

use App\Models\Chauffeur;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveChaufffeur extends Notification
{
    use Queueable;

    public $chauffeur;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Chauffeur $chauffeur)
    {
        $this->chauffeur = $chauffeur;
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
        $subject = sprintf('%s:Vous aver l\'acces a l\'espace chauffeur %s', config('app.name'), '');
        $greeting = sprintf('Bonjour  %s', $notifiable->nom);
        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line('Dans cette espace vous recevoire les demande des client')
            ->line('Merci de mentionné que vous avez commence au terminer votre mission')
            ->action('decouvrir votre espace chauffeur', url('/chauffeur/conexion'))
            ->line('');
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
