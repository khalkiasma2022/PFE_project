<?php

namespace App\Http\Controllers\espace_technicien\consulter_liste_produit;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class ConsulterListeProduitTechController extends Controller
{
    //
    public function liste_produit_tech()
    {
        $produits = Produit::orderBy('ID_produit', 'desc')->get();
        return view('espace_technicien.consulter_liste_produit.consulter_produit_tech', compact('produits'));
    }
    public function show(Produit $produits)
    {
        return view('espace_technicien.consulter_liste_produit.consulter_produit_tech', compact('produits'));

    }
}
