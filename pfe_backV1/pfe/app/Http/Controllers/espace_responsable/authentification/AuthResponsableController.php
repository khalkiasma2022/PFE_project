<?php

namespace App\Http\Controllers\espace_responsable\authentification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\Responsable; 

class AuthResponsableController extends Controller
{
    // Afficher la page de connexion
    public function ViewPage()
    {
        return view('espace_responsable.authentification.auth_resp');
    }

    // Traiter la tentative de connexion
    public function login(Request $request)
{
    $request->validate([
        'matricule' => 'required|string',
        'password' => 'required|string',
    ]);

    $responsable = Responsable::where('Matricule_resp', $request->matricule)->first();

    if (!$responsable) {
        return back()->withInput()->withErrors(['matricule' => 'Matricule incorrect']);
    }

    if (!Hash::check($request->password, $responsable->Mot_de_passe_resp)) {
        return back()->withInput()->withErrors(['password' => 'Mot de passe incorrect']);
    }

    Auth::guard('responsable')->login($responsable, $request->remember ?? false);
    
    return redirect()->intended(route('responsable.dashboard'));
}
    // Déconnexion
    public function logout(Request $request)
    {
        Auth::guard('responsable')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/espace-responsable/login');
    }
}