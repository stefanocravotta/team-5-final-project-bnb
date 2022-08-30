<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorisation extends Model
{
    public function dwellings() {
        return $this->belongsToMany('App\Dwelling');
    }
}
