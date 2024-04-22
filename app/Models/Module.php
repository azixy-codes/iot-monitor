<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    // Champs remplissable par formulaire
    protected $fillable = ['nom', 'description', 'type_mesure_id', 'debut_fonctionnement', 'donnees_par_seconde', 'etat_marche'];

    // Attributs additionnels pour le module
    protected $appends = ['time_elapsed_in_seconds', 'duree_fonctionnement', 'donnees_envoyees'];

    // Relation avec la table types de mesures (Chaque module a un type de mesure)
    public function type_de_mesure()
    {
        return $this->belongsTo(TypeMesure::class, 'type_mesure_id', 'id');
    }

    // Relation avec la table historique (Chaque module a plusieurs valeurs dans l'historique)
    public function historique()
    {
        return $this->hasMany(Historique::class);
    }

    // Relation avec la table notifications (Chaque module plusieurs)
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Récupération des notification du module qui sont non lues
    public function notificationsNonLus()
    {
        return $this->notifications->where('read', 0);
    }

    // Valeur de l'attribut additionnel 'time_elapsed_in_seconds'
    public function getTimeElapsedInSecondsAttribute()
    {
        return abs(Carbon::now()->diffInSeconds($this->debut_fonctionnement));
    }

    // Valeur de l'attribut additionnel 'duree_fonctionnement'
    public function getDureeFonctionnementAttribute()
    {
        $timeElapsed = Carbon::now()->diff($this->debut_fonctionnement);

        return $this->time_elapsed_in_seconds > 0 ? $timeElapsed->format('%hh %imin') : 0;
    }

    // Valeur de l'attribut additionnel 'donnees_envoyees'
    public function getDonneesEnvoyeesAttribute()
    {
        return number_format(($this->donnees_par_seconde * $this->time_elapsed_in_seconds / 1024), 2);
    }
}
