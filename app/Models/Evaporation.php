<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaporation extends Model
{
    protected $table = 'evaporation'; // Nom de la table
    protected $primaryKey = 'ID_evaporation'; // Clé primaire
    public $timestamps = false; // Désactiver les timestamps automatiques
    protected $fillable = [
        'produit_utilise',
        'Matricule_tech_evaporation',
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
