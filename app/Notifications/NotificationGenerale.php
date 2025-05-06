<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

//importer le modèle de notification

class NotificationGenerale extends Notification
{
    use Queueable;

    protected $data; // Une variable pour stocker les infos

    // 1. Constructor pour recevoir les infos de la notification
    public function __construct($data)
    {
        $this->data = $data;
    }

    // 2. Dire que c'est envoyé dans la base de données
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    // 3. Ce qu'on enregistre dans la base
    public function toDatabase(object $notifiable): array
    {
        return [
            'titre' => $this->data['titre'],
            'message' => $this->data['message'],
            'url' => $this->data['url'] ?? null,
        ];
    }

    // 4. Optionnel : si tu veux un tableau brut
    public function toArray(object $notifiable): array
    {
        return [
            'titre' => $this->data['titre'],
            'message' => $this->data['message'],
            'url' => $this->data['url'] ?? null,
        ];
    }
}
