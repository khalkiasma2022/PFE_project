<?php

namespace App\Http\Controllers\espace_responsable;

use App\Http\Controllers\Controller;
use App\Models\Responsable;
use App\Models\Technicien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ListeUtilisateurController extends Controller
{
    public function ViewPage()
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

        return view('espace_responsable.afficher_liste_user.user_list', [
            'users' => $users
        ]);
    }
}
