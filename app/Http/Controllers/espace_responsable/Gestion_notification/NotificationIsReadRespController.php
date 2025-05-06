<?php

namespace App\Http\Controllers\espace_responsable\Gestion_notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NotificationGenerale; // Ensure this class exists in the App\Notifications namespace

// If the class is in a different namespace, update the namespace accordingly, e.g.:
// use App\YourCorrectNamespace\NotificationGenerale;
use Illuminate\Support\Facades\Auth;

class NotificationIsReadRespController extends Controller
{
    public function marquerCommeLue($id)
        {
            $notification = Auth::user()->notifications->where('id', $id)->first();

            // Vérifie que la notification existe et est pour le responsable connecté
            if ($notification && $notification->Matricule_responsable_notif == Auth::user()->Matricule_resp) {
                $notification->is_read = true;
                $notification->save();
            }

            return redirect()->route('responsable.notifications');
        }

        public function afficherNotifications()
        {
            $responsable = Auth::guard('responsable')->user();

            // Récupérer les notifications non lues
            $notificationsNonLues = NotificationGenerale::where('Matricule_responsable_notif', $responsable->Matricule_resp)
                                               ->where('is_read', false)
                                               ->count();

            // Récupérer toutes les notifications (non lues et lues)
            $notifications = NotificationGenerale::where('Matricule_responsable_notif', $responsable->Matricule_resp)
                                          ->orderBy('created_at', 'desc')
                                          ->get();

            return view('responsable.notifications', compact('notifications', 'notificationsNonLues'));
        }

}
