<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dwelling;
use App\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index() {
        $dwellings = Dwelling::where('user_id', Auth::id())->get();
        $all_views = [];

        foreach ($dwellings as $dwelling) {

            $views = View::where('dwelling_id', $dwelling->id)->get();

            foreach ($views as $view) {

                array_push($all_views, $view);
            }
        }

        $today = Carbon::now();
        $this_month = null;

        if (substr($today,5,1) == 0) {

            $this_month = substr($today,6,1);
        }
        else {

            $this_month = substr($today,5,2);
        }

        $months = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];

        return view('user.statistics', compact('dwellings','all_views','this_month','months'));
    }
}
