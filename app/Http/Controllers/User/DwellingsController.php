<?php

namespace App\Http\Controllers\User;

use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use App\Dwelling;
use App\Http\Requests\DwellingRequest;

class DwellingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $dwellings_visible = Dwelling::where('user_id', $user_id)->where('visible', 1)->orderBy('id', 'desc')->get();
        $dwellings_pending = Dwelling::where('user_id', $user_id)->where('visible', 0)->orderBy('id', 'desc')->get();

        return view('user.dwellings.index', compact('dwellings_visible', 'dwellings_pending'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $categories = Category::all();
        return view('user.dwellings.create', compact('user_id','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DwellingRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['slug'] = Dwelling::generateSlug($data['name']);



        $httpClient = new \GuzzleHttp\Client();
        $provider = new \Geocoder\Provider\TomTom\TomTom($httpClient, '1ICjwoAETA30YhhNatAlLrdJ6g8V1ZDc');
        $geocoder = new \Geocoder\StatefulGeocoder($provider);

        $result = $geocoder->geocodeQuery(GeocodeQuery::create($data['address'], $data['city']));

        $data['lat'] = $result->get(0)->getCoordinates()->getLatitude();
        $data['long'] = $result->get(0)->getCoordinates()->getLongitude();

        $new_dwelling = new Dwelling;
        $new_dwelling->fill($data);
        $new_dwelling->save();

        return redirect()->route('user.dwellings.show', $new_dwelling)->with('dwelling_created', "La struttura $new_dwelling->name è stata aggiunta correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dwelling $dwelling)
    {
        if ($dwelling->user_id == Auth::id()) {

            return view('user.dwellings.show', compact('dwelling'));
        }else{
            $user_id = Auth::id();
            $dwellings = Dwelling::where('user_id', $user_id)->orderBy('id', 'desc')->get();
            return redirect()->route('user.dwellings.index', compact('dwellings'))->with('not_allowed', "E' impossibile visualizzare appartamenti di altri utenti");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dwelling =  Dwelling::find($id);
        $categories = Category::all();
        return view('user.dwellings.edit', compact('dwelling', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DwellingRequest $request, Dwelling $dwelling)
    {
        $data = $request->all();

        if($data['name'] != $dwelling->name){

            $data['slug']=Dwelling::generateSlug($data['name']);

        };

        if($data['address'] != $dwelling->address || $data['city'] != $dwelling->city){

            $httpClient = new \GuzzleHttp\Client();
            $provider = new \Geocoder\Provider\TomTom\TomTom($httpClient, '1ICjwoAETA30YhhNatAlLrdJ6g8V1ZDc');
            $geocoder = new \Geocoder\StatefulGeocoder($provider);

            $result = $geocoder->geocodeQuery(GeocodeQuery::create($data['address'], $data['city']));

            $data['lat'] = $result->get(0)->getCoordinates()->getLatitude();
            $data['long'] = $result->get(0)->getCoordinates()->getLongitude();

        };


        $dwelling->update($data);

        return redirect()->route('user.dwellings.show', $dwelling);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dwelling $dwelling)
    {
     $dwelling->delete();
     return redirect()->route('user.dwellings.index')->with('dwelling_deleted', "La struttura $dwelling->name è stata cancellata correttamente");
    }
}
