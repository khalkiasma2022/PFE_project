<?php

namespace App\Http\Controllers\espace_responsable\Gestion_notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationGenarale; // N'oublie pas d'importer ton modèle

class NotificationGenaraleController extends Controller
{
    // Méthode pour récupérer toutes les notifications et les envoyer à la vue
    public function index()
    {
        // Récupérer toutes les notifications
        $notifications = NotificationGenarale::all();

        // Envoyer les notifications à la vue
        return view('responsable.dashboard', compact('notifications'));
    }
}
