<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use Sluggable;

    protected $table = 'categories';
    protected $fillable = [
        'designation', 'NbrPlaceMax', 'image', 'slug', 'description'
    ];

    public function chauffeurs()
    {
        return $this->hasMany('App\Models\Chauffeur');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'designation'
            ]
        ];
    }


    public function scopeSelection($query)
    {
        return $query->select('id', 'designation', 'NbrPlaceMax', 'image', 'slug', 'description');
    }

    public function scopeSelection2($query)
    {
        return $query->select('id');
    }

    public function getImageAttribute($val)
    {
        return ($val != null) ? asset('/assets/' . $val) : '';
    }

    public function vehicules()
    {
        return $this->hasMany('App\Models\Vehicule');
    }
}
