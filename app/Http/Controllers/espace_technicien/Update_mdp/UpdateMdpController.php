<?php

namespace App\Http\Controllers\espace_technicien\Update_mdp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technicien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UpdateMdpController extends Controller
{
    public function ViewPage()
    {
        return view('espace_technicien.Update_mdp.update_mdp');
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
        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            return redirect()->route('technicien.login')->withErrors(['error' => 'Utilisateur non authentifié']);
        }

        // Modifier le mot de passe
        $technicien->Mot_de_passe_tech = Hash::make($request->password);
        $technicien->save();

        return redirect()->intended(route('technicien.dashboard'))
            ->with('success', 'Mot de passe modifié avec succès.');
    }
}
