<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;

class GenerationEtatModules extends Command
{

    protected $signature = 'module:generate-status';

    protected $description = 'Généeration de l\'état de marche des modules';

    public function handle()
    {
        $modules = Module::all();

        foreach ($modules as $module) {

            // Générer l'etat du module avec 10% pour une panne
            if (rand(1, 100) <= 10) {
                $module->etat_marche = 2;
            } else {
                $module->etat_marche = rand(0, 1);
            }

            $module->save();
        }

        $this->info('Génération de l\'état de marche des modules avec succés.');
    }
}
