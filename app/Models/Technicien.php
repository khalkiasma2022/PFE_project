<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Technicien extends Authenticatable
{
    use Notifiable;

    protected $table = 'technicien';
    protected $primaryKey = 'Matricule_tech';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'Matricule_tech',
        'Nom_tech',
        'Email_tech',
        'Mot_de_passe_tech',
        'Prenom_tech',
        'CIN_tech',

    ];

    protected $hidden = [
        'Mot_de_passe',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->Mot_de_passe_tech;
    }
}
