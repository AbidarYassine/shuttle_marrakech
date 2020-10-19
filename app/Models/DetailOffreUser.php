<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOffreUser extends Model
{
    protected $table = 'detail_offre_users';
    protected $fillable = [
        'offreDetail_id', 'user_id', 'avisClient', 'score',
    ];
}
