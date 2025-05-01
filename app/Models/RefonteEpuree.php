<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefonteEpuree extends Model
{
    //
    protected $table = 'refonte_epuree'; // Nom de la table
    protected $primaryKey = 'ID_prelevement'; // Clé primaire
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
        'ID_lot',
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
