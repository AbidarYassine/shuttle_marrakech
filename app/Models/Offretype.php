<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Offretype extends Model
{
    use Sluggable;

    protected $table = 'offretypes';
    protected $fillable = [
        'offreType', 'slug'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'offreType'
            ]
        ];
    }

    public function offres()
    {
        return $this->hasMany('App\Models\Offre')->where('active', '=', '1');
    }


    public function scopeSelection($query)
    {
        return $query->whereHas('offres', function ($Offrequery) {
            $Offrequery->where('active', 1);
        });
    }

//    public function getOffreTypeAttribute($val)
//    {
//        return ($val != null) ? '' : '';
//    }
}
