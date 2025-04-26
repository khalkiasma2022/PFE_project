<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Responsable extends Authenticatable
{
    protected $table = 'responsable';
    protected $primaryKey = 'Matricule_resp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Matricule_resp',
        'Nom_resp',
        'Email_resp',
        'Mot_de_passe_resp'
    ];

    protected $hidden = [
        'Mot_de_passe_resp',
        'remember_token',
    ];

    // Spécifier le nom du champ mot de passe
    public function getAuthPassword()
    {
        return $this->Mot_de_passe_resp;
    }

    // Spécifier le nom du champ identifiant
    public function getAuthIdentifierName()
    {
        return 'Matricule_resp';
    }
}