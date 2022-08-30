<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public static function generateSlug($nome){
        $slug = Str::slug($nome, '-');
        $base_slug = $slug;
        $slug_exist = Category::where('slug', $slug)->first();
        $c = 1;

        while($slug_exist){
            $slug = $base_slug . '-' . $c;
            $c++;
            $slug_exist = Category::where('slug', $slug)->first();
        }

        return $slug;
    }
}
