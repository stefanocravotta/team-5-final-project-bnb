<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreMessageController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($data,
            [
                'email' => 'required|email',
                'text' => 'required'
            ],
            [
                'email.required' => 'La mail é obbligatoria',
                'email.email' => 'Inserisci una mail valida',
                'text.required' => 'Inserisci un messaggio da inviare'
            ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_message = new Message();
        $new_message->dwelling_id = $request->dwelling_id;
        $new_message->sender_email = $request->email;
        $new_message->text = $request->text;
        $new_message->save();

        return response()->json(['success'=>true]);
    }
}
