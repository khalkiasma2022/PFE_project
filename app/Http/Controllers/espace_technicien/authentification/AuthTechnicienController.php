<?php

namespace App\Http\Controllers\espace_technicien\authentification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Technicien;

class AuthTechnicienController extends Controller
{
    // Afficher la page de connexion
    public function ViewPage()
    {
        return view('espace_technicien.authentification.auth_tech');
    }

    // Traiter la tentative de connexion
    public function login(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string',
            'password' => 'required|string',
        ]);

        $technicien = Technicien::where('Matricule_tech', $request->matricule)->first();

        if (!$technicien) {
            return back()
                ->withInput()
                ->withErrors(['matricule' => 'Matricule incorrect']);
        }

        if (!Hash::check($request->password, $technicien->Mot_de_passe_tech)) {
            return back()
                ->withInput()
                ->withErrors(['password' => 'Mot de passe incorrect']);
        }

        Auth::guard('technicien')->login($technicien, $request->remember ?? false);

        return redirect()->intended(route('technicien.dashboard'))
            ->with('success', 'Connexion réussie');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::guard('technicien')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/espace-technicien/login');
    }
}
