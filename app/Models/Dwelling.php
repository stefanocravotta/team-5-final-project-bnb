<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public static function generateSlug($nome){
        $slug = Str::slug($nome, '-');
        $base_slug = $slug;
        $slug_exist = Dwelling::where('slug', $slug)->first();
        $c = 1;

        while($slug_exist){
            $slug = $base_slug . '-' . $c;
            $c++;
            $slug_exist = Dwelling::where('slug', $slug)->first();
        }

        return $slug;
    }
}
