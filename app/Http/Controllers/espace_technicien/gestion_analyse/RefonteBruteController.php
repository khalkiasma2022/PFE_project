<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefonteBrutee; // Adjusted namespace to match the actual location of the RefonteBrutee model
use App\Models\historique_donnees; // Adjusted namespace to match the actual location of the historique_donnees model
use Illuminate\Support\Facades\Auth;


class RefonteBruteController extends Controller
{
    //fonction pour afficher la page de la refonte brute
    public function ViewPage()
    {
        return view('espace_technicien.gestion_analyse.process_production.refonte_brute');
    }

    public function AjouteRefonteBrute(Request $request)
{
    $request->validate([
        'brix' => 'required|numeric',
        'ph' => 'required|numeric',
        'temperature' => 'required|numeric',
        'color-hex' => 'required|string',
    ]);

    $technicien = Auth::guard('technicien')->user();

    if (!$technicien) {
        abort(403, 'Non autorisé : aucun technicien connecté.');
    }

    // Création de l'entrée dans la table RefonteBrutee
    $refonteBrute = RefonteBrutee::create([
        'Matricule_tech' => $technicien->Matricule_tech,
        'Date_refonte_brutee' => now(),
        'PH' => $request->ph,
        'bx' => $request->brix,
        'temperature' => $request->temperature,
        'couleur' => $request->input('color-hex'),
    ]);

    // Récupération de l'ID du dernier enregistrement inséré
    $refonteBrute_ID = $refonteBrute->ID_prelevement; // Utilisation de l'ID de l'enregistrement

    // Enregistrement dans l'historique
    historique_donnees::create([
        'matricule_technicien' => $technicien->Matricule_tech, // Assign the technician's matricule
        'ID_prelevement' => $refonteBrute_ID, // Utilisation de l'ID de la refonte brute
        'nom_etape' => 'Refonte brute',
        'date_enregistrement' => now(),
    ]);

    return redirect()->route('liste_etape_view')->with('success', "L’enregistrement de l’analyse a été effectué avec succès par le technicien matricule {$technicien->Matricule_tech}. Vous pouvez désormais accéder à la page de l’historique, si vous le souhaitez.");
}

}
