<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produit'; // Nom de la table
    protected $primaryKey = 'ID_produit'; // Clé primaire
    public $timestamps = false; // Désactiver les timestamps automatiques

    protected $fillable = [
        'Nom_produit',
        'information_produit',
        'quantite_produit'
    ];

    // Optionnel : format des dates
    protected $dates = ['created_at', 'updated_at'];
}
