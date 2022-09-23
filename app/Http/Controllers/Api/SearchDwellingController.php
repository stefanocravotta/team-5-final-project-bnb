<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Dwelling;
use App\Perk;
use App\View;
use App\Sponsorisation;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Geocoder\Query\GeocodeQuery;
use Illuminate\Http\Request;


class SearchDwellingController extends Controller
{
    public function getDwellingsByCity($city, $range){

        $coordinates = $this->getCityCoordinates($city);

        $lat = $coordinates['lat'];
        $long = $coordinates['long'];

        // $radius = (int)$radius;
        $radius = (int)$range * 0.009;

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

    public function SearchDwelling($city, $range){

        $coordinates = $this->getCityCoordinates($city);

        $dwellings = $this->getDwellingsByCity($city, $range);

        $perks = Perk::all();

        $categories = Category::all();


        return response()->json(compact('dwellings', 'perks', 'categories', 'coordinates'));
    }

    public function showDwelling($slug, $ip_address){

        $dwelling = Dwelling::where('slug', $slug)->with('perks')->first();

        if ($ip_address != 'error') {

            $last_view = View::orderBy('created_at', 'DESC')->where('ip_address', $ip_address)->where('dwelling_id', $dwelling->id)->first();

            if ($last_view == '') {

                $new_view = new View();
                $new_view->dwelling_id = $dwelling->id;
                $new_view->ip_address = $ip_address;
                $new_view->save();
            }
            else {
                $last_view_data = explode(' ', $last_view->created_at);

                $last_view_date = $last_view_data[0];
                $last_view_time = $last_view_data[1];

                $today = explode(' ', Carbon::now());
                $today_date = $today[0];
                $today_time = substr($today[1], 0, 8);

                if ($today_date > $last_view_date && $today_time >= $last_view_time) {

                    $new_view = new View();
                    $new_view->dwelling_id = $dwelling->id;
                    $new_view->ip_address = $ip_address;
                    $new_view->save();
                }
            }
        }

        $categories = Category::all();

        return response()->json(compact('dwelling', 'categories'));
    }

    public function getSponsoredDwellings(){

        $today = Carbon::now('Europe/Rome');

        $dwellings = Dwelling::whereNotNull('expiration_date')->with('perks')->get();

        $categories = Category::all();

        foreach ($dwellings as $key => $dwelling) {
            if (Carbon::parse($dwelling->expiration_date) < $today) {
                $dwelling->sponsorisations()->detach();
               unset($dwellings[$key]);
               $dwelling->expiration_date = null;
               $dwelling->save();
            }
        }

        return response()->json(compact('dwellings', 'categories'));
    }

    public function getDwellingByCityTop($city){

        $coordinates = $this->getCityCoordinates($city);

        $dwellings = $this->getDwellingsByCity($city);

        $perks = Perk::all();

        $categories = Category::all();

        return response()->json(compact('dwellings', 'perks', 'categories', 'coordinates'));

    }
}
