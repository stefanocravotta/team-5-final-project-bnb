<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function dwelling() {
        return $this->belongsTo('App\Models\Dwelling');
    }
}
