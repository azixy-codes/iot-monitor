<?php

namespace Database\Seeders;

use App\Models\Historique;
use App\Models\Module;
use App\Models\TypeMesure;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        TypeMesure::create(['nom' => 'Type non connu']);
        TypeMesure::create(['nom' => 'Température']);
        TypeMesure::create(['nom' => 'Vitesse']);
        TypeMesure::create(['nom' => 'Surface']);
        TypeMesure::create(['nom' => 'Puissance éléctrique']);

        Module::create([
            'nom' => 'Robot aspirateur',
            'type_mesure_id' => TypeMesure::all()->random()->id,
            'debut_fonctionnement' => Null,
            'donnees_par_seconde' => rand(1, 10),
            'etat_marche' => 0
        ]);
        Module::create([
            'nom' => 'Camera pour animaux',
            'type_mesure_id' => TypeMesure::all()->random()->id,
            'debut_fonctionnement' => now(),
            'donnees_par_seconde' => rand(1, 10),
            'etat_marche' => 1
        ]);
        Module::create([
            'nom' => 'Purificateur d\'air',
            'type_mesure_id' => TypeMesure::all()->random()->id,
            'debut_fonctionnement' => now(),
            'donnees_par_seconde' => rand(1, 10),
            'etat_marche' => 1
        ]);
        Module::create([
            'nom' => 'Ampoule intelligente',
            'type_mesure_id' => TypeMesure::all()->random()->id,
            'debut_fonctionnement' => Null,
            'donnees_par_seconde' => rand(1, 10),
            'etat_marche' => 2
        ]);
        Module::create([
            'nom' => 'Frigo',
            'type_mesure_id' => TypeMesure::all()->random()->id,
            'debut_fonctionnement' => Null,
            'donnees_par_seconde' => rand(1, 10),
            'etat_marche' => 0
        ]);
        Module::create([
            'nom' => 'Clime',
            'type_mesure_id' => TypeMesure::all()->random()->id,
            'debut_fonctionnement' => Null,
            'donnees_par_seconde' => rand(1, 10),
            'etat_marche' => 0
        ]);

        Historique::factory(50)->create();
    }
}
