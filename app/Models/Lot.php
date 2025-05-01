<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    // Nom de la table si elle est différente du modèle ("lots" au pluriel serait automatique sinon)
    protected $table = 'Lot';

    // La clé primaire n'est pas 'id', c'est 'ID_lot'
    protected $primaryKey = 'ID_lot';

    // Si ta table n'utilise pas created_at / updated_at
    public $timestamps = false;

    // Liste des colonnes qui peuvent être remplies avec create() ou update()
    protected $fillable = [
        'Matricule_technicien',
        'Statue',
        'Date_lot',
    ];

    // Relation avec le technicien
    public function technicien()
    {
        return $this->belongsTo(Technicien::class, 'Matricule_technicien', 'Matricule_tech');
    }


    // Automatically set the current date and time for 'Date_refonte_brutee'
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->Date_lot = now();
        });
    }

}
