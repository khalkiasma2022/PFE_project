<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefonteBrutee; // Adjusted namespace to match the actual location of the RefonteBrutee model
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

        //$technicien = Auth::guard('technicien')->user(); // 👈 Utilise ton guard ici !
        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            abort(403, 'Non autorisé : aucun technicien connecté.');
        }

        RefonteBrutee::create([
            //'produit_utilise' => $request->input('produit_utilise'),
            'Matricule_tech' => $technicien->Matricule_tech, // ou autre valeur correcte
            'Date_refonte_brutee' => now(),
            'PH' => $request->ph,
            'bx' => $request->brix,
            'temperature' => $request->temperature,
            'couleur' => $request->input('color-hex'),
        ]);

        return redirect()->route('liste_etape_view')->with('success', 'Refonte enregistrée avec succès !');
    }
}
