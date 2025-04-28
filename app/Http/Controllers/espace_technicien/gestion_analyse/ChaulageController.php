<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chaulage; // Assurez-vous d'importer le modèle Chaulage

class ChaulageController extends Controller
{
    //
    public function ViewPage()
    {
        return view('espace_technicien.gestion_analyse.process_production.chaulage');
    }

    public function AjouteChaulage(Request $request)
    {
        $request->validate([
            'Lait_chaux_input' => 'required|numeric',
            'CO2_input' => 'required|numeric',
        ]);

        // 👈 Utilise ton guard ici !
        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            abort(403, 'Non autorisé : aucun technicien connecté.');
        }

        Chaulage::create([
            //'produit_utilise' => $request->input('produit_utilise'),
            'Matricule_tech' => $technicien->Matricule_tech, // ou autre valeur correcte
            'DateHeure' => now(), // Date et heure actuelles
            'lait_de_chaux_input' => $request->lait_de_chaux,
            'CO2_input' => $request->CO2_input,

        ]);

        return redirect()->route('liste_etape_view')->with('success', 'Analyse enregistrée avec succès !');
    }
}
