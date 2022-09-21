<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Dwelling;

class UserController extends Controller
{
    public function index(){

        $user_dwellings = Dwelling::where('user_id', Auth::id())->get();
        $all_views = [];

        foreach ($user_dwellings as $dwelling) {

            $views = View::where('dwelling_id', $dwelling->id)->get();

            foreach ($views as $view) {

                array_push($all_views, $view);
            }
        }

        return view('user.dashboard', compact('all_views'));
    }
}
