<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot; // Adjusted namespace to match the actual location of the Lot model

class ListeEtapeController extends Controller
{
    //fonction pour afficher la page
    public function ViewPage(Request $request)
    {
        $id_lot = $request->query('id');  // Récupérer l'ID du lot depuis l'URL

        $lot = Lot::find($id_lot);  // Récupérer les détails du lot à partir de l'ID

        // Si le lot n'est pas trouvé, afficher une erreur
        if (!$lot) {
            abort(404, 'Lot non trouvé');
        }
        return view('espace_technicien.gestion_analyse.choix_etape.choix_etape', compact('lot')); // Passer le lot à la vue
    }

}
