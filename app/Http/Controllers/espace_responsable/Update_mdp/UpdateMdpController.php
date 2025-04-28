<?php

namespace App\Http\Controllers\espace_responsable\Update_mdp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Responsable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UpdateMdpController extends Controller
{
    public function ViewPage()
    {
        return view('espace_responsable.update_mdp.update_mdp');
    }
    public function updatePassword(Request $request)
    {
        // Valider le nouveau mot de passe
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Récupérer le technicien connecté
        $responsable = Auth::guard('responsable')->user();

        if (!$responsable) {
            return redirect()->route('responsable.login')->withErrors(['error' => 'Utilisateur non authentifié']);
        }

        // Modifier le mot de passe
        $responsable->Mot_de_passe = Hash::make($request->password);
        $responsable->save();

        // Modifier le mot de passe
        $responsable->Mot_de_passe = Hash::make($request->password);
        $responsable->save();

        // Changer ici
        return redirect()->route('responsable.dashboard')->with('success', 'Mot de passe mis à jour avec succès');

    }
}
