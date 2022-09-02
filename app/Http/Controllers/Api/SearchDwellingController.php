<?php

namespace App\Http\Controllers\Api;

use App\Dwelling;
use App\Http\Controllers\Controller;
use Geocoder\Query\GeocodeQuery;
use Illuminate\Http\Request;


class SearchDwellingController extends Controller
{
    public function SearchDwelling($city){

        $httpClient = new \GuzzleHttp\Client();
        $provider = new \Geocoder\Provider\TomTom\TomTom($httpClient, '1ICjwoAETA30YhhNatAlLrdJ6g8V1ZDc');
        $geocoder = new \Geocoder\StatefulGeocoder($provider);
        $address = $city;

        $result = $geocoder->geocodeQuery(GeocodeQuery::create("$address"));

// lat 0,00900901

        $lat = $result->get(0)->getCoordinates()->getLatitude();
        $long = $result->get(0)->getCoordinates()->getLongitude();

        $distance = $lat + 0.3;

        $dwellings = Dwelling::whereBetween('lat', [$lat, $distance])->get();

        return response()->json(compact('dwellings', 'lat', 'long'));
    }

}
