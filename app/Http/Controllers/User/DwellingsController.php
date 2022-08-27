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
        $dwellings = Dwelling::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('user.dwellings.index', compact('dwellings'));
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
    public function store(Request $request)
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
        return view('user.dwellings.show', compact('dwelling'));
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
    public function update(Request $request, Dwelling $dwelling)
    {
        $data = $request->all();
        $data['slug']=Dwelling::generateSlug($data['name']);
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
