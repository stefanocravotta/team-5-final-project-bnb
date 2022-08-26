<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perk extends Model
{
    public function dwellings() {
        return $this->belongsToMany('App\Models\Dwelling');
    }
}
