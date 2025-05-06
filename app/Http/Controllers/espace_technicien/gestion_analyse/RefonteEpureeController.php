<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Models\Responsable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RefonteEpuree; // Adjusted namespace to match the actual location of the RefonteEpuree model
use App\Models\historique_donnees; // Assurez-vous d'importer le modèle historique_donnees
use App\Models\Lot; // Assurez-vous d'importer le modèle Lot
class RefonteEpureeController extends Controller
{
    public function ViewPage(Request $request)

    {
        $id_lot = $request->query('id'); // Récupérer l'ID du lot depuis l'URL

        $lot = Lot::find($id_lot); // Récupérer les détails du lot à partir de l'ID

        // Si le lot n'est pas trouvé, afficher une erreur
        if (!$lot) {
            abort(404, 'Lot non trouvé');
        }
        return view('espace_technicien.gestion_analyse.process_production.refonte_epure', compact('lot'));
    }

    public function AjouteAnalyse(Request $request)
    {
        $request->validate([
            'brix' => 'required|numeric',
            'ph' => 'required|numeric',
            'color-hex' => 'required|string',
        ]);

        $nom_etape = 'Refonte épurée'; // Nom de l'étape
        $id_lot = $request->input('id_lot'); // Récupérer l'ID du lot depuis le formulaire

        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            abort(403, 'Non autorisé : aucun technicien connecté.');
        }

        // Création de l'entrée dans la table RefonteBrutee
        $refonteBrute = RefonteEpuree::create([
            'Matricule_tech' => $technicien->Matricule_tech,
            'DateHeure' => now(),
            'pH' => $request->input('ph'),
            'Brix' => $request->input('brix'),
            'Color' => $request->input('color-hex'),
            'ID_lot' => $id_lot, // Associer le lot à la refonte brute
        ]);

        // Enregistrement dans l'historique
        historique_donnees::create([
            'matricule_technicien' => $technicien->Matricule_tech,
            'ID_prelevement' => $refonteBrute->ID_prelevement,
            'nom_etape' => $nom_etape,
            'Date_historique' => now(),
        ]);

        // Récupération de la date du lot
        $date_lot = Lot::find($id_lot)->Date_lot;

         // Récupérer tous les responsables
         $responsables = Responsable::all();

         // Créer le contenu de la notification
         $contenuNotification = "Nous vous informons que le technicien {$technicien->Nom_tech} {$technicien->Prenom_tech}, portant le matricule {$technicien->Matricule_tech}, a procédé à l'enregistrement d'une nouvelle analyse dans le cadre de l'étape intitulée '{$nom_etape}'. Cette analyse concerne un nouveau lot identifié par l'ID {$id_lot}, lequel a été créé en date du {$date_lot}.";

         // Pour chaque responsable, on insère une notification
         foreach ($responsables as $responsable) {
             \DB::table('notificationgenerale')->insert([
                 'contenu_notification' => $contenuNotification,
                 'Matricule_technicien_notif' => $technicien->Matricule_tech,
                 'Matricule_responsable_notif' => $responsable->Matricule_resp, // Matricule du responsable
                 'created_at' => now(), // La date actuelle pour created_at
             ]);
         }

        return redirect()->route('gestion_lot_view')->with('success', "L’analyse de l'étape {$nom_etape} a été enregistrée avec succès pour le lot ID {$id_lot}. DATE : " . now()->format('Y-m-d H:i:s') . " . Matricule : " . $technicien->Matricule_tech);
    }
}
