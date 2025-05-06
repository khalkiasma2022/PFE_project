<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot; // Adjusted namespace to match the actual location of the Lot model
use App\Models\Technicien; 

class LotController extends Controller
{
    //fonction pour afficher la page de gestion des lots
    public function ViewPage()
    {
        // Récupérer tous les lots
        $lots = Lot::where('statue', 'En cours')->get(); // Récupérer les lots en cours
        // Passer les lots à la vue
        return view('espace_technicien.gestion_analyse.gestion_lot.gestion_lot', compact('lots'));
    }

}
