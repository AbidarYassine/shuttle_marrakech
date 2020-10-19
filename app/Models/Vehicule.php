<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Vehicule extends Model
{
    use Sluggable;

    protected $table = 'vehicules';
    protected $fillable = [
        'matricule', 'model', 'marque', 'chauffeur_id', 'image', 'categorie_id', 'nombre_valise', 'slug',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'marque'
            ]
        ];
    }

    public function offreDetails()
    {
        return $this->hasMany('App\Models\OffreDetail');
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'matricule', 'model', 'marque', 'chauffeur_id', 'categorie_id', 'image', 'slug', 'nombre_valise');
    }

    public function scopeMarque($query)
    {
        return $query->select('id', 'model', 'marque');
    }

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Chauffeur');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }
//    public function prixOffre()
//    {
//        return $this->belongsTo('App\Models\PrixOffre', 'prixoffre_id');
//    }
    public function offres()
    {
        return $this->hasMany('App\Models\Offre')->where('active', 1);
    }


    public function getImageAttribute($val)
    {
        return ($val != null) ? asset('/assets/' . $val) : '';
    }

    public function scopeActiveCauff($query)
    {
        return $query->whereHas('chauffeur', function ($Offrequery) {
            $Offrequery->where('active', 1);
        });
    }
}
