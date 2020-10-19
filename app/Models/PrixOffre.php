<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrixOffre extends Model
{
    protected $tablle = 'prix_offres';
    protected $fillable = [
        'transfert_simple', 'transfert_aller_retour', 'mise_à_disposition', 'soiré'
    ];


    public function offre()
    {
        return $this->hasMany('App\Models\Offre','prixoffre_id','id');
    }
}
