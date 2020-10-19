<?php

namespace App\Notifications;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaiementSuccess extends Notification
{
    use Queueable;

    public $admin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
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
        $subject = sprintf('%s:une offre est choisit par un client %s', config('app.name'), '');
        $greeting = sprintf('Hello %s', $notifiable->name);
        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ## info client
            ->line('##########  Information Client  ##########')
            ->line('Nom Client: ' . ' ' . $notifiable->client->name)
            ->line('Email Client: ' . ' ' . $notifiable->client->email)
            ->line('Telephone Client : ' . ' ' . $notifiable->client->telephone)
            ### info l'offre ######
            ->line('##########  Information Offre  ##########')
            ->line('Départ: ' . ' ' . $notifiable->offreDetail->offre->depart)
            ->line('Arriver: ' . ' ' . $notifiable->offreDetail->offre->arriver)
            ->line('Date de départ: ' . ' ' . $notifiable->offreDetail->date_rdv)
            ->line('Heure de départ: ' . ' ' . $notifiable->offreDetail->heure)
            ->line('Service Choisit: ' . ' ' . $notifiable->offreDetail->service)
            ->line('Nombre de jour: ' . ' ' . $notifiable->offreDetail->nbrjour)
            ->line('Date Arriver: ' . ' ' . date('Y-m-d', strtotime($notifiable->offreDetail->date_rdv.'+'.($notifiable->offreDetail->nbrjour).'days')))
            ->line('Date Retour: ' . ' ' . $notifiable->offreDetail->date_retour)
            ->line('Heure Retour: ' . ' ' . $notifiable->offreDetail->heure_retour)
            ->line('Prix Total: ' . ' ' . $notifiable->prix . " DH")
            ### info categorie ####
            ->line('##########  Information Véhicule  ##########')
            ->line('Véhicule: ' . ' ' . $notifiable->offre->marque . " " . $notifiable->offre->model)
            ->line('Categorie: ' . ' ' . $notifiable->offre->categorie->designation)
            ->line('Nombre de place: ' . ' ' . $notifiable->offre->categorie->NbrPlaceMax)
            ->action('Detail de paiement', url('admin/offreDetail'));

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
            //if notification by database
        ];
    }
}
