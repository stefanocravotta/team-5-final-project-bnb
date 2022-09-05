<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function authUser(){

        if (Auth::check()) {
            $user = "The user is logged in";
        } else {
            $user = "Utente non loggato";
        }

        return $user;
    }
}
