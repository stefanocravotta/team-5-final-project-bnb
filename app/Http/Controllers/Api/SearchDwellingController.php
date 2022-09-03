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

        $result = $geocoder->geocodeQuery(GeocodeQuery::create($address));

        $lat = $result->get(0)->getCoordinates()->getLatitude();
        $long = $result->get(0)->getCoordinates()->getLongitude();

        $distance_lat = $lat + 0.05;
        $dista_lat = $lat - 0.05;

        $distance_long = $long + 0.05;
        $dista_long = $long - 0.05;

        $dwellings = Dwelling::whereBetween('lat', [$dista_lat, $distance_lat])->whereBetween('long', [$dista_long, $distance_long])->get();

        return response()->json(compact('dwellings', 'address'));
    }

}
