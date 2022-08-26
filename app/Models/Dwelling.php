<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dwelling extends Model
{
    public function sponsorisations() {
        return $this->belongsToMany('App\Models\Sponsorisation');
    }

    public function perks() {
        return $this->belongsToMany('App\Models\Perk');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }

    public function views() {
        return $this->hasMany('App\Models\View');
    }

    // public function images() {
    //     return $this->hasMany('App\Models\Image');
    // }

    // public function category() {
    //     return $this->belongsTo('App\Models\Category');
    // }
}
