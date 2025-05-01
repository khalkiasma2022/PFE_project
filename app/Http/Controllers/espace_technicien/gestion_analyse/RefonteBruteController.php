<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefonteBrutee; // Adjusted namespace to match the actual location of the RefonteBrutee model
use App\Models\historique_donnees; // Adjusted namespace to match the actual location of the historique_donnees model
use Illuminate\Support\Facades\Auth;
use App\Models\Lot; // Adjusted namespace to match the actual location of the Lot model


class RefonteBruteController extends Controller
{
    //fonction pour afficher la page de la refonte brute
    public function ViewPage(Request $request)
    {
        $id_lot = $request->query('id'); // Récupérer l'ID du lot depuis l'URL

    $lot = Lot::find($id_lot); // Récupérer les détails du lot à partir de l'ID

    // Si le lot n'est pas trouvé, afficher une erreur
    if (!$lot) {
        abort(404, 'Lot non trouvé');
    }

    return view('espace_technicien.gestion_analyse.process_production.refonte_brute', compact('lot'));
    }
    //fonction pour afficher la page de la refonte brute
    public function ViewPageNewLotRefonte()
    {
        return view('espace_technicien.gestion_analyse.gestion_lot.Formulaire_refontebrute');
    }


    public function AjouteRefonteBrute(Request $request)
    {
        $request->validate([
            'brix' => 'required|numeric',
            'ph' => 'required|numeric',
            'temperature' => 'required|numeric',
            'color-hex' => 'required|string',
        ]);

        $id_lot = $request->input('id_lot'); // Récupérer l'ID du lot depuis le formulaire

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
            'ID_lot' => $id_lot, // Associer le lot à la refonte brute
        ]);

        // Enregistrement dans l'historique
        historique_donnees::create([
            'matricule_technicien' => $technicien->Matricule_tech,
            'ID_prelevement' => $refonteBrute->ID_prelevement,
            'nom_etape' => 'Refonte brute',
            'Date_historique' => now(),
        ]);

        return redirect()->route('gestion_lot_view')->with('success', "L’analyse a été enregistrée avec succès pour le lot ID {$id_lot}.");
    }
    public function AjouteRefonteBrute_lot(Request $request){

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
              // Creation d'un nouveau lot
              $lot = Lot::create([
                'Matricule_technicien' => $technicien->Matricule_tech,
                'Statue' => 'En cours',
                'Date_lot' => now(),
            ]);

            // Récupération de l'ID du lot
            $id_lot = $lot->ID_lot; // Utilisation de l'ID du lot

            // Création de l'entrée dans la table RefonteBrutee
            $refonteBrute = RefonteBrutee::create([
                'Matricule_tech' => $technicien->Matricule_tech,
                'Date_refonte_brutee' => now(),
                'PH' => $request->ph,
                'bx' => $request->brix,
                'temperature' => $request->temperature,
                'couleur' => $request->input('color-hex'),
                'ID_lot' => $id_lot, // Associer le lot à la refonte brute
            ]);

            // Récupération de l'ID du dernier enregistrement inséré
            $refonteBrute_ID = $refonteBrute->ID_prelevement; // Utilisation de l'ID de l'enregistrement

            // Enregistrement dans l'historique
            historique_donnees::create([
                'matricule_technicien' => $technicien->Matricule_tech, // Assign the technician's matricule
                'ID_prelevement' => $refonteBrute_ID, // Utilisation de l'ID de la refonte brute
                'nom_etape' => 'Refonte brute',
                'Date_historique' => now(),
                'ID_lot' => $id_lot, // Associer le lot à l'historique
            ]);

            return redirect()->route('gestion_lot_view')->with('success', "L’enregistrement de l’analyse a été effectué avec succès par le technicien matricule {$technicien->Matricule_tech}. Le nouveau lot a été créé avec succès avec l'ID {$id_lot}. Vous pouvez désormais accéder à la page de l’historique, si vous le souhaitez.");
        }

    }


