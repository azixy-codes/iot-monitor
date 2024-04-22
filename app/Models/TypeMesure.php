<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMesure extends Model
{
    use HasFactory;

    protected $table = 'types_mesures';

    protected $guarded = [];

    // Relation avec la table module (Chaque type de mesures peut être associés  plusieurs modules)
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
