<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Notification;

class HomeController extends Controller
{
    // Retourne la vue du tableau de bord
    public function index()
    {
        $data = [
            'modules'  => Module::where('etat_marche', 1)->take(10)->get(),
            'notifications' => Notification::orderByDesc('id')->take(10)->get()
        ];

        return view('dashboard', $data);
    }
}
