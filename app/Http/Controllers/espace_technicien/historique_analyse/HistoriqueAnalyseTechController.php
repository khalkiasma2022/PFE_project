<?php

namespace App\Http\Controllers\espace_technicien\historique_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\historique_donnees;
use App\Models\RefonteBrutee; // Adjusted namespace to match the actual location of the RefonteBrutee model
use Illuminate\Support\Facades\Auth;

class HistoriqueAnalyseTechController extends Controller
{
    //afficher la page historique analyse
    public function ViewPage ()
    {
        return view('espace_technicien.historique_analyse.historique_analyse');
    }

    //afficher la liste des analyses
    public function AfficherHistorique()
{
    // Récupérer tous les enregistrements de la table historique_donnees avec leurs relations (Technicien et Responsable)
    $historiques = historique_donnees::with(['Technicien', 'Responsable'])->get();

    // Retourner la vue avec les données historiques
    return view('espace_technicien.historique_analyse.historique_analyse', compact('historiques'));
}

}
