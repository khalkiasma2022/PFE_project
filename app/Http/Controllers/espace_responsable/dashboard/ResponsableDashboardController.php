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


    public function index()
    {
        return view('espace_responsable.dashboard.index', [
            'responsable' => auth()->guard('responsable')->user()
        ]);
    }

}
