<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    // retourne l'historique
    public function index()
    {
        $historique = Historique::with('module:id,nom')->orderByDesc('id')->paginate(10);
        return view('historique.index', compact('historique'));
    }
}
