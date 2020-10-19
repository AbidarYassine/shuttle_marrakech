<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Chauffeur extends Authenticatable
{
    use Sluggable;
    use Notifiable;

    protected $table = 'chauffeurs';
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'address', 'slug', 'image', 'active', 'disponible', 'telephone', 'typePermi', 'categorie_id', 'numeroPermi'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nom'
            ]
        ];
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'nom', 'active', 'prenom', 'address', 'image', 'telephone', 'disponible', 'typePermi', 'categorie_id', 'numeroPermi', 'slug', 'email');
    }

    public function getActiveAttribute($val)
    {
        if ($val) {
            return "Active";
        } else {
            return "Non Active";
        }
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeDisponible($query)
    {
        return $query->where('disponible', 1);
    }

    public function scopeActivedisponible($query)
    {
        return $query->where('disponible', 1)->where('active', 1);
    }

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }

    public function vehicule()
    {
        return $this->hasMany('App\Models\Vehicule');
    }

    public function getImageAttribute($val)
    {
        return ($val != null) ? asset('/assets/' . $val) : '';
    }

//
    public function detailoffres()
    {
        return $this->hasMany('App\Models\OffreDetail');
    }

}

