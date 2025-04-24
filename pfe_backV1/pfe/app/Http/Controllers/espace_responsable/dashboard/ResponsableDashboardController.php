<?php

namespace App\Http\Controllers\espace_responsable\dashboard;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Responsable;
use App\Models\Technicien;

class ResponsableDashboardController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:responsable');
    }
    public function gestionUtilisateurs()
{
    $responsable = auth()->guard('responsable')->user();
    
    $techniciens = Technicien::select(
        'Matricule_tech as Matricule',
        'Nom_tech as Nom',
        'Email_tech as Email',
        DB::raw("'technicien' as type")
    )->orderBy('Nom_tech', 'asc')->get();
    
    $responsables = Responsable::where('Matricule_resp', '!=', $responsable->Matricule_resp)
        ->select(
            'Matricule_resp as Matricule',
            'Nom_resp as Nom',
            'Email_resp as Email',
            DB::raw("'responsable' as type")
        )
        ->orderBy('Nom_resp', 'asc')
        ->get();

    $users = $techniciens->concat($responsables);

    return view('espace_responsable.gestion_utilisateurs', [
        'users' => $users
    ]);
}

    public function index()
    {
        $responsable = auth()->guard('responsable')->user();
        
        // Récupération des techniciens avec les champs spécifiques
        $techniciens = Technicien::select(
            'Matricule_tech as Matricule',
            'Nom_tech as Nom',
            'Email_tech as Email',
            DB::raw("'technicien' as type")
        )->orderBy('Nom_tech', 'asc')->get();
        
        // Récupération des responsables (sauf celui connecté)
        $responsables = Responsable::where('Matricule_resp', '!=', $responsable->Matricule_resp)
            ->select(
                'Matricule_resp as Matricule',
                'Nom_resp as Nom',
                'Email_resp as Email',
                DB::raw("'responsable' as type")
            )
            ->orderBy('Nom_resp', 'asc')
            ->get();

        $users = $techniciens->concat($responsables);

        return view('espace_responsable.dashboard.index', [
            'responsable' => [
                'Matricule' => $responsable->Matricule_resp,
                'Nom' => $responsable->Nom_resp,
                'Email' => $responsable->Email_resp
            ],
            'users' => $users
        ]);
    }
}