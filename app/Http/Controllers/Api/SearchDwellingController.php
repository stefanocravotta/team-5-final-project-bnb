<?php

namespace App\Http\Controllers\Api;

use App\Dwelling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchDwellingController extends Controller
{
    public function SearchDwelling($apartment){

        $dwellings = Dwelling::whereBetween('lat', [-24, -23])->get();

        return response()->json(compact('dwellings'));
    }
}
