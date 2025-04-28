<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeuxiemeCarbo extends Model
{
    protected $table = 'deuxieme_carbo'; // Nom de la table
    protected $primaryKey = 'ID_deuxieme_carbo'; // Clé primaire
    public $timestamps = false; // Désactiver les timestamps automatiques
    protected $fillable = [
        'produit_utilise',
        'Matricule_tech',
        'DateHeure',
        'PH',
        'bx',
        'temperature',
        'alcal',
        'couleur',
    ];
     // Automatically set the current date and time for 'Date_refonte_brutee'
     public static function boot()
     {
         parent::boot();

         static::creating(function ($model) {
             $model->DateHeure = now();
         });
     }
}
