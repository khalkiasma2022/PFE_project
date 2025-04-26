<?php

namespace App\Http\Controllers\espace_technicien\dashboard;

use Illuminate\Routing\Controller as BaseController; // Import crucial
use Illuminate\Http\Request;

class TechnicienDashboardController extends BaseController
{
    public function __construct()
    {
        // Utilisation correcte du middleware
        $this->middleware('auth:technicien');
    }

    public function index()
    {
        return view('espace_technicien.dashboard.index', [
            'technicien' => auth()->guard('technicien')->user()
        ]);
    }
}