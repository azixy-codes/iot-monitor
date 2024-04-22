<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Notification;
use App\Models\TypeMesure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    // Retourne la vue d'ffichage de tous les modules
    public function index()
    {
        $modules = Module::with('historique')->orderByDesc('id')->paginate(5);
        return view('modules.index', compact('modules'));
    }

    // Retourne la vue d'affichage d'un module
    public function show($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.show', compact('module'));
    }

    // Retourne la vue de création du module
    public function create()
    {
        $types = TypeMesure::get(['id', 'nom']);
        return view('modules.create', ['types_mesures' => $types]);
    }

    // Création du module dans la base de données
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required|max:255',
            'donnees' => ['required', 'integer', 'between:1,10'],
            'type' => ['required', Rule::exists('types_mesures', 'id')],
            'etat' => ['required', Rule::in([0, 1, 2])]
        ]);

        $debut_fonctionnement = NULL;

        if ($request->etat_marche === 1) {
            // Module en état de marche
            $debut_fonctionnement = now();
        } else {
            // Module en état d'arret ou de panne 
            $debut_fonctionnement = NULL;
        }

        Module::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'donnees_par_seconde' => $request->donnees,
            'type_mesure_id' => $request->type,
            'debut_fonctionnement' => $debut_fonctionnement,
            'etat_marche' => $request->etat
        ]);

        return redirect()->route('modules.index')
            ->with('success', 'Module ajouté avec succés.');
    }

    // Retourne vers la vue d'édition du module
    public function edit($id)
    {
        $module = Module::findOrFail($id);
        $types = TypeMesure::get(['id', 'nom']);

        $data = [
            'module' => $module,
            'types_mesures' => $types
        ];

        return view('modules.edit', $data);
    }

    // Sauvegarde des modifications du module dans la base de données
    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required|max:255',
            'donnees' => ['required', 'integer', 'between:1,10'],
            'type' => ['required', Rule::exists('types_mesures', 'id')],
            'etat' => ['required', Rule::in([0, 1, 2])]
        ]);

        $module = Module::findOrFail($id);

        // Verification si l'état a changé
        if ((int) $request->etat !== $module->etat_marche) {
            // Vérification si le nouveau état est en marche
            if ((int) $request->etat === 1) {
                $module->debut_fonctionnement = now();
            } else {
                // changement vers état d'arret ou de panne
                $module->debut_fonctionnement = NULL;
            }
        }

        // Si le module tombe en panne, on notifie
        if ((int) $request->etat === 2) {
            $notification = new Notification();

            $notification->message = 'Le module ' . $module->nom . ' est en panne !';
            $notification->type = 'panne';

            $module->notifications()->save($notification);
        }

        // Mise à jour du module
        $module->nom = $request->nom;
        $module->description = $request->description;
        $module->donnees_par_seconde = $request->donnees;
        $module->type_mesure_id = $request->type;
        $module->etat_marche = $request->etat;

        $module->save();

        return redirect()->route('modules.index')->with('success', 'Module mis à jour.');
    }

    // Suppression du module
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')
            ->with('success', 'Module supprimé avec succés.');
    }
}
