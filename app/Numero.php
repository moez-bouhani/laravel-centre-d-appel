<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    protected $fillable = [
        'nom', 'prenom','adresse', 'code_postale','telephone','statut','date_nais','user_id'
    ];
}
