<?php

namespace App\Http\Controllers\Api;

use App\Dwelling;
use App\Http\Controllers\Controller;
use Geocoder\Query\GeocodeQuery;
use Illuminate\Http\Request;


class SearchDwellingController extends Controller
{
    public function SearchDwelling($city){

        // // dd($city);
        // $httpClient = new \GuzzleHttp\Client();
        // $provider = new \Geocoder\Provider\TomTom\TomTom($httpClient, '1ICjwoAETA30YhhNatAlLrdJ6g8V1ZDc');
        // $geocoder = new \Geocoder\StatefulGeocoder($provider);
        // $address = $city;

        // $result = $geocoder->geocodeQuery(GeocodeQuery::create("$address"));

        // $lat = $result->get(0)->getCoordinates()->getLatitude();
        // $long = $result->get(0)->getCoordinates()->getLongitude();

        // dd($lat, $long);
        // $dwellings = Dwelling::whereBetween('lat', [$lat, ($lat + 1)])->get();

        $dwellings = Dwelling::all();
        return response()->json(compact('dwellings'));
    }
}
