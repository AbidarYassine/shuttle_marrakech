<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use Sluggable;


    protected $table = 'offres';
    protected $fillable = [
        'depart', 'arriver', 'slug', 'active', 'vehicule_id', 'prixoffre_id',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'depart'
            ]
        ];
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'depart', 'arriver', 'slug', 'active', 'vehicule_id', 'prixoffre_id');
    }

    public function getImageVehiculeAttribute($val)
    {
        return ($val != null) ? asset('/assets/' . $val) : '';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


    public function prixOffre()
    {
        return $this->belongsTo('App\Models\PrixOffre', 'prixoffre_id', 'id');
    }

    // public function offretype()
    // {
    //     return $this->belongsTo('App\Models\Offretype');
    // }

    public function chauffeurs()
    {
        return $this->belongsToMany('App\Models\Chauffeur', 'chauffeur_offres');
    }

    public function offreDetails()
    {
        return $this->hasMany('App\Models\OffreDetail');
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule');
    }

}
