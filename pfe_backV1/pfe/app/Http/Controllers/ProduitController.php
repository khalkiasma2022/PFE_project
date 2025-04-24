<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Afficher la liste des produits
     */
    public function index()
    {
        $produits = Produit::orderBy('ID_produit', 'desc')->get();
        return view('produits.index', compact('produits'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Enregistrer un nouveau produit
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nom_produit' => 'required|string|max:100',
            'information_produit' => 'required|string',
            'quantite_produit' => 'required|integer|min:0'
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')
                        ->with('success', 'Produit créé avec succès');
    }

    /**
     * Afficher un produit spécifique
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'Nom_produit' => 'required|string|max:100',
            'information_produit' => 'required|string',
            'quantite_produit' => 'required|integer|min:0'
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')
                        ->with('success', 'Produit mis à jour avec succès');
    }

    /**
     * Supprimer un produit
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index')
                        ->with('success', 'Produit supprimé avec succès');
    }
}