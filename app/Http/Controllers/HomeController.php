<?php

namespace App\Http\Controllers;

use App\Models\Module;

class HomeController extends Controller
{
    // Retourne la vue du tableau de bord
    public function index()
    {
        $modules  = Module::where('etat_marche', 1)->take(10)->get();

        return view('dashboard', compact('modules'));
    }
}
