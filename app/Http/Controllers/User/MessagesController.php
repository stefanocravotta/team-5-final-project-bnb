<?php

namespace App\Http\Controllers\User;

use App\Dwelling;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function index(){

        $user_id = Auth::id();

        /* $messages = DB::table('messages')
        ->select('*')
        ->join('dwellings', 'dwellings.id', '=', 'messages.dwelling_id')
        ->where('dwellings.user_id', $user_id)
        ->groupBy('messages.dwelling_id')
        ->get(); */

        $dwellings = Dwelling::where('user_id' , $user_id)->with('messages')->get();


        return view('user.messages', compact('dwellings'));
    }
}
