<?php

namespace App\Http\Controllers\User;
use App\Perk;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $perk_name = Perk::all()->get();
        return view('layouts.app', compact('perk_name'));
    }
}
