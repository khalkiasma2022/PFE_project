<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use App\Models\Evaporation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvapurationController extends Controller
{
    public function ViewPage()
    {
        return view('espace_technicien.gestion_analyse.process_production.evapuration');
    }
    public function AjouteAnalyse(Request $request)
    {
        $request->validate([
            'brix' => 'required|numeric',
            'ph' => 'required|numeric',
            'color-hex' => 'required|string',
        ]);

        //$technicien = Auth::guard('technicien')->user(); // 👈 Utilise ton guard ici !
        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            abort(403, 'Non autorisé : aucun technicien connecté.');
        }

        Evaporation::create([
            //'produit_utilise' => $request->input('produit_utilise'),
            'Matricule_tech_evaporation' => $technicien->Matricule_tech, // ou autre valeur correcte
            'Date_refonte_brutee' => now(),
            'PH' => $request->ph,
            'bx' => $request->brix,
            'couleur' => $request->input('color-hex'),
        ]);

        return redirect()->route('liste_etape_view')->with('success', 'Analyse enregistrée avec succès !');
    }
}
