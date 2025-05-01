<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\PremierCarbo; // Assurez-vous d'importer le modèle PremierCarbo
use App\Models\Lot; // Assurez-vous d'importer le modèle Lot
use App\Models\historique_donnees; // Assurez-vous d'importer le modèle historique_donnees


class PremierCarboController extends Controller
{
    public function ViewPage(Request $request)
    {
        $id_lot = $request->query('id'); // Récupérer l'ID du lot depuis l'URL

        $lot = Lot::find($id_lot); // Récupérer les détails du lot à partir de l'ID

        // Si le lot n'est pas trouvé, afficher une erreur
        if (!$lot) {
            abort(404, 'Lot non trouvé');
        }
        return view('espace_technicien.gestion_analyse.process_production.premier_carbo',compact('lot'));
    }

    public function enregistrerAnalyse(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'lait_de_chaux_input' => 'required|numeric|min:0',
            'CO2_input' => 'required|numeric|min:0',
        ]);

        $nom_etape = 'Premier Carbonatation';
        $id_lot = $request->input('id_lot'); // Récupérer l'ID du lot depuis le formulaire

        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            abort(403, 'Non autorisé : aucun technicien connecté.');
        }

        // Création de l'entrée dans la table RefonteBrutee
        $Prmier_carbo = PremierCarbo::create([
            'Matricule_tech' => $technicien->Matricule_tech,
            'DateHeure' => now(),
            'lait_de_chaux' => $request->input('lait_de_chaux_input'),
            'CO2' => $request->input('CO2_input'),
            'ID_lot' => $id_lot, // Associer le lot à la refonte brute
        ]);

        // Enregistrement dans l'historique
        historique_donnees::create([
            'matricule_technicien' => $technicien->Matricule_tech,
            'ID_prelevement' => $Prmier_carbo->ID_prelevement,
            'nom_etape' => $nom_etape,
            'Date_historique' => now(),
        ]);

        return redirect()->route('gestion_lot_view')->with('success', "L’analyse de l'étape {$nom_etape} a été enregistrée avec succès pour le lot ID {$id_lot}. DATE : " . now()->format('Y-m-d H:i:s') . " . Matricule : " . $technicien->Matricule_tech);
    }
}
