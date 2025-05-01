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
        // Récupérer les enregistrements de la table historique_donnees et filtrer par ID_lot
        $historiques = historique_donnees::whereNotNull('ID_lot') // Filtrer uniquement les enregistrements avec un ID_lot
            ->get();

        // Retourner la vue avec les données historiques
        return view('espace_technicien.historique_analyse.historique_analyse', compact('historiques'));
    }

    public function DetailHistorique_ViewPage(){
        return view('espace_technicien.historique_analyse.detail_historique');

    }

}
