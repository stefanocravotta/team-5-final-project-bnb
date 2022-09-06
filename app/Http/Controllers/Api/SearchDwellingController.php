<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Dwelling;
use App\Perk;
use App\Http\Controllers\Controller;
use Geocoder\Query\GeocodeQuery;
use Illuminate\Http\Request;


class SearchDwellingController extends Controller
{
    public function getDwellingsByCity($city){
        $httpClient = new \GuzzleHttp\Client();
        $provider = new \Geocoder\Provider\TomTom\TomTom($httpClient, '1ICjwoAETA30YhhNatAlLrdJ6g8V1ZDc');
        $geocoder = new \Geocoder\StatefulGeocoder($provider);
        $address = $city;

        $result = $geocoder->geocodeQuery(GeocodeQuery::create($address));

        $lat = $result->get(0)->getCoordinates()->getLatitude();
        $long = $result->get(0)->getCoordinates()->getLongitude();

        $radius = 0.2;

        $dwellings = Dwelling::whereBetween('lat', [$lat - $radius, $lat + $radius])->whereBetween('long', [$long - $radius, $long + $radius])->with('perks')->get();

        return $dwellings;

    }

    public function SearchDwelling($city){

        $dwellings = $this->getDwellingsByCity($city);

        $perks = Perk::all();

        $categories = Category::all();


        return response()->json(compact('dwellings', 'perks', 'categories'));
    }

    public function searchByCategory($category, $dwelling){


        $dwellings_by_city = $this->getDwellingsByCity($dwelling);

        // dd($dwellings_by_city);

        $apartment = Dwelling::where('category', $category)->get();


        return response()->json(compact('apartment'));
    }


}
