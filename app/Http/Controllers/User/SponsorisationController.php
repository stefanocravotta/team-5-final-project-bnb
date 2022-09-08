<?php

namespace App\Http\Controllers\User;

use App\Dwelling;
use App\Http\Controllers\Controller;
use App\Http\Requests\SponsorisationRequest;
use App\Sponsorisation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorisationController extends Controller
{
    public function index(){

        $user_id = Auth::id();
        $sponsorisations = Sponsorisation::all();
        $dwellings_user = Dwelling::where('user_id', $user_id)->get();

        return view('user.sponsorisation', compact('sponsorisations','dwellings_user'));
    }

    public function update(SponsorisationRequest $request){

        $data = $request->all();


        $sponsorisation = Sponsorisation::where('id', $data['sponsorisation_id'])->first();

        $dwelling = Dwelling::where('id', $data['dwelling_id'])->first();

        dd($dwelling->sponsorisations);

        /* foreach ($dwelling->sponsorisations as $sponsorisation){
            dd($sponsorisation->pivot->DwellingsSponsorisation);
        } */

        $today = Carbon::now('Europe/Rome')->format('d-m-Y H:i');

        $data['start_date'] = $today;

        $data['expiration_date'] = Carbon::now('Europe/Rome')->addHours($sponsorisation->time)->format('d-m-Y H:i');

        $dwelling->sponsorisations()->sync(['']);

        // Cambiare da many to many a one to many e vaffanculo!




    }


}
