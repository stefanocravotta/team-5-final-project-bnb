<?php

namespace App\Http\Controllers\User;

session_start();
require_once('../vendor/autoload.php');

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

        $gateway = new \Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('user.sponsorisation', compact('sponsorisations','dwellings_user', 'token'));
    }

    public function update(SponsorisationRequest $request){

        $data = $request->all();

        $sponsorisation = Sponsorisation::where('price', $data['amount'])->first();

        $dwelling = Dwelling::where('id', $data['dwelling_id'])->first();

        $today = Carbon::now('Europe/Rome');

        if (Carbon::parse($dwelling->expiration_date) < $today) {

            $dwelling->expiration_date = null;
            $dwelling->update();
        }

        $dwelling->star_date = $today;

        $date_expiration = Carbon::parse($dwelling->expiration_date);

        //$dwelling->expiration_date = Carbon::now('Europe/Rome')->addHours($sponsorisation->time)->format('d-m-Y');

        if($dwelling->expiration_date != null){
            $dwelling->expiration_date = $date_expiration->addHours($sponsorisation->time);
        }else{
            $dwelling->expiration_date = Carbon::now('Europe/Rome')->addHours($sponsorisation->time);
        }

        $dwelling->update();

        $dwelling->sponsorisations()->attach($sponsorisation->id);

        $gateway = new \Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            return redirect()->route('user.dashboard')->with('success_message', 'Transazione accettata');
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return redirect()->route('user.dashboard')->with('error_message', 'Transazione negata');
        }

    }

}
