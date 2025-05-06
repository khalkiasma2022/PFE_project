<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationGenarale extends Model
{
    use HasFactory;

    protected $table = 'notificationgenerale'; // OK

    protected $fillable = [
        'contenu_notification', // correction : enlevé le 'e'
        'Matricule_technicien_notif',
        'Matricule_responsable_notif',
        'created_at', // ajouté pour insérer created_at manuellement
    ];
}
