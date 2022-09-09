<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Dwelling;
use App\Perk;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Geocoder\Query\GeocodeQuery;
use Illuminate\Http\Request;


class SearchDwellingController extends Controller
{
    public function getDwellingsByCity($city){

        $coordinates = $this->getCityCoordinates($city);

        $lat = $coordinates['lat'];
        $long = $coordinates['long'];

        $radius = 0.2;

        $dwellings = Dwelling::whereBetween('lat', [$lat - $radius, $lat + $radius])->whereBetween('long', [$long - $radius, $long + $radius])->with('perks')->get();

        return $dwellings;

    }

    public function getCityCoordinates($city) {
        $httpClient = new \GuzzleHttp\Client();
        $provider = new \Geocoder\Provider\TomTom\TomTom($httpClient, '1ICjwoAETA30YhhNatAlLrdJ6g8V1ZDc');
        $geocoder = new \Geocoder\StatefulGeocoder($provider);

        $result = $geocoder->geocodeQuery(GeocodeQuery::create($city));

        $lat = $result->get(0)->getCoordinates()->getLatitude();
        $long = $result->get(0)->getCoordinates()->getLongitude();

        return compact('lat', 'long');

    }

    public function SearchDwelling($city){

        $coordinates = $this->getCityCoordinates($city);

        $dwellings = $this->getDwellingsByCity($city);

        $perks = Perk::all();

        $categories = Category::all();


        return response()->json(compact('dwellings', 'perks', 'categories', 'coordinates'));
    }

    public function showDwelling($slug){

        $dwelling = Dwelling::where('slug', $slug)->with('perks')->first();
        // dd($dwelling);

        $categories = Category::all();
        // dd($categories);

        return response()->json(compact('dwelling', 'categories'));
    }

    public function getSponsoredDwellings(){

        $today = Carbon::now('Europe/Rome');

        $dwellings = Dwelling::whereNotNull('expiration_date')->get();

        $categories = Category::all();

        foreach ($dwellings as $key => $dwelling) {
           if (Carbon::parse($dwelling->expiration_date) < $today) {

               unset($dwellings[$key]);
           }
        }

        return response()->json(compact('dwellings', 'categories'));
    }
}
