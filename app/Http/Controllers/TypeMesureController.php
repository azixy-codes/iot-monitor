<?php

namespace App\Http\Controllers;

use App\Models\TypeMesure;
use Illuminate\Http\Request;

class TypeMesureController extends Controller
{
    // Retourne la vue d'affichage des types de mesures
    public function index()
    {
        $types = TypeMesure::with('modules:nom,type_mesure_id')->orderByDesc('id')->paginate(10);
        return view('types-mesures.index', compact('types'));
    }

    // Retourne la vue de création du type de mesures
    public function create()
    {
        return view('types-mesures.create');
    }

    // Création du type de mesure dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
        ]);

        TypeMesure::create(['nom' => $request->nom]);

        return redirect()->route('types_mesures.index')
            ->with('success', 'Type de mesure ajouté avec succés.');
    }

    // Retourne la vue d'édition du type de mesure
    public function edit(string $id)
    {
        $type = TypeMesure::findOrFail($id);

        return view('types-mesures.edit', compact('type'));
    }

    // Sauvegarde des modifications du type de mesures dans la base de données
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|max:255',
        ]);

        $module = TypeMesure::findOrFail($id);

        $module->nom = $request->nom;

        $module->save();

        return redirect()->route('types_mesures.index')->with('success', 'Type de mesure mis à jour.');
    }

    // Suppression du type de mesure
    public function destroy($id)
    {
        $type = TypeMesure::findOrFail($id);
        $type->delete();

        return redirect()->route('types_mesures.index')
            ->with('success', 'Type de mesure supprimé avec succés.');
    }
}
