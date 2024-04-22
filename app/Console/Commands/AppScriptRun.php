<?php

namespace App\Console\Commands;

use App\Models\Historique;
use App\Models\Module;
use App\Models\Notification;
use Illuminate\Console\Command;

class AppScriptRun extends Command
{
    protected $signature = 'app:app-script-run';

    protected $description = 'Simulation des données des modules';

    public function handle()
    {
        $modules = Module::all();

        foreach ($modules as $module) {

            // 5% de possibilté de panne lorsque le module est en marche
            if (rand(1, 100) <= 5 && $module->etat_marche === 1) {
                $module->etat_marche = 2;
                $module->debut_fonctionnement = NULL;
                $module->save();
                // Création de la notification de panne
                $notification = new Notification();

                $notification->message = 'Le module ' . $module->nom . ' est en panne !';
                $notification->type = 'panne';

                $module->notifications()->save($notification);
            }

            $historique = new Historique();

            if ($module->etat_marche === 1) {
                $historique->valeur_mesuree = rand(1, 30);
            } else {
                $historique->valeur_mesuree = 0;
            }

            $module->historique()->save($historique);
        }

        $this->info('Génération des données de simulation avec succées.');
    }
}
