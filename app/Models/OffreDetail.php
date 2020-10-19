<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreDetail extends Model
{
    protected $table = 'offre_details';
    protected $fillable = [
        'date_rdv', 'heure', 'offre_id', 'status', 'chauffeur_id', 'created_at', 'updated_at', 'date_retour', 'heure_retour', 'service', 'nbrjour', 'vehicule_id'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function offre()
    {
        return $this->belongsTo('App\Models\Offre');
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'date_rdv', 'heure', 'offre_id', 'chauffeur_id', 'date_retour', 'service', 'heure_retour', 'nbrjour', 'vehicule_id', 'updated_at', 'created_at', 'date_retour');
    }

    public function scopeActiveOffre($query)
    {
        return $query->whereHas('offre', function ($Offrequery) {
            $Offrequery->where('active', 0);
        });
    }

    public function scopeActivePrix($query)
    {
        return $query->whereHas('offre', function ($Offrequery) {
            $Offrequery->where('prixoffre_id', '!=', 0);
        });
    }

    public function scopeActiveOf($query)
    {
        return $query->whereHas('offre', function ($Offrequery) {
            $Offrequery->where('active', 1);
        });
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule');
    }


    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Chauffeur');
    }
}
