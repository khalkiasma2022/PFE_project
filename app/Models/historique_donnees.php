<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class historique_donnees extends Model
{
    use HasFactory;

    protected $table = 'historique_donnees';
    protected $primaryKey = 'ID_historique';
    public $timestamps = false;

    // Define the fillable attributes

    protected $fillable = [
        'matricule_technicien',
        'matricule_responsable',
        'date_enregistrement',
        'ID_prelevement',
        'nom_etape',

    ];

    // Relations

    public function Technicien()
    {
        return $this->belongsTo(Technicien::class, 'matricule_technicien', 'Matricule_tech');
    }

    public function Responsable()
    {
        return $this->belongsTo(Responsable::class, 'matricule_responsable', 'Matricule_resp');
    }


    // Automatically set the current date and time for 'Date_refonte_brutee'
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->date_enregistrement= now();
        });
    }

}
