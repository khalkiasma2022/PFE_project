<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeuxiemeCarbo; // Assurez-vous d'importer le modèle PremierCarbo

class DeuxiemeCarboController extends Controller
{
    public function ViewPage()
    {
        return view('espace_technicien.gestion_analyse.process_production.deuxieme_carbo');
    }

    public function enregistrerAnalyse(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'ph' => 'required|numeric|min:0|max:14',
            'temperature' => 'required|numeric',
            'alcalinite' => 'required|numeric|min:0',
        ]);

        // Récupérer le technicien connecté
        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            abort(403, 'Non autorisé : Technicien non connecté.');
        }

        // Créer une nouvelle analyse
        DeuxiemeCarbo::create([
            //'produit_utilise' => 'Carbo', // ou autre valeur par défaut si tu veux
            'Matricule_tech' => $technicien->Matricule_tech,
            'PH' => $request->ph,
            'temperature' => $request->temperature,
            'alcal' => $request->alcalinite,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('liste_etape_view')->with('success', 'Analyse enregistrée avec succès !');
    }
}
