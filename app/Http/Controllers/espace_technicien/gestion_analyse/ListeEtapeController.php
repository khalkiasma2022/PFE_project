<?php

namespace App\Http\Controllers\espace_technicien\gestion_analyse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListeEtapeController extends Controller
{
    //fonction pour afficher la page
    public function ViewPage()
    {
        return view('espace_technicien.gestion_analyse.choix_etape.choix_etape');
    }

}
