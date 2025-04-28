<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chaulage extends Model
{
    //
    protected $table = 'chaulage'; // Nom de la table
    protected $primaryKey = 'ID_chaulage'; // Clé primaire
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
        'lait_de_chaux',
        'CO2',
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
