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

        $today = Carbon::now('Europe/Rome');

        $dwelling->star_date = $today;

        $dwelling->expiration_date = Carbon::now('Europe/Rome')->addHours($sponsorisation->time);

        $dwelling->sponsored = 1;

        $dwelling->update();

        $dwelling->sponsorisations()->attach($sponsorisation->id);

        return redirect()->route('user.dashboard');



    }


}
