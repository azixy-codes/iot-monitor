<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Champs remplissable par formulaire
    protected $fillable = ['message', 'module_id', 'type'];

    // Relation avec la table module (Chaque notification appartient à un module)
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
