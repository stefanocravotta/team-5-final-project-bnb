<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dwelling extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'category',
        'rooms',
        'beds',
        'bathrooms',
        'dimentions',
        'long',
        'lat',
        'address',
        'city',
        'description',
        'image',
        'visible',
        'price'
    ];

    public function sponsorisations() {
        return $this->belongsToMany('App\Sponsorisation');
    }

    public function perks() {
        return $this->belongsToMany('App\Perk');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    // public function images() {
    //     return $this->hasMany('App\Image');
    // }

    // public function category() {
    //     return $this->belongsTo('App\Category');
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
