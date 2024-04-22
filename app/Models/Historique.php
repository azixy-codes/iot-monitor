<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $table = 'historique';

    protected $guarded = [];

    // Relation avec la table modules (Chaque valeur d'histtorique appartient à un module)
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
