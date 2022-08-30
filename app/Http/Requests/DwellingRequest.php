<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DwellingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:3|max:255',
            'rooms'=>'nullable|numeric|max:25',
            'beds'=>'nullable|numeric|max:25',
            'bathrooms'=>'nullable|numeric|max:25',
            'dimentions'=>'nullable|numeric|min:10',
            'address'=>'required|min:5|max:255',
            'city'=>'required|min:3|max:255',
            'description'=>'nullable|min:20|max:2000',
            'image'=>'max:32000',
            'price'=>'required|numeric|max:1000000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio',
            'name.min' => 'Il campo nome deve avere almeno :min caratteri',
            'name.max' => 'Il campo nome può avere massimo :max caratteri',

            'rooms.numeric' => 'Il campo numero di stanze deve essere un numero',
            'rooms.max' => 'Non puoi registrare un appartamento con più di :max stanze',

            'beds.numeric' => 'Il numero di letti deve essere un numero',
            'beds.max' => 'Non puoi registrare un appartamento con più di :max letti',

            'bathrooms.numeric' => 'Il numero di bagni deve essere un numero',
            'bathrooms.max' => 'Non puoi registrare un appartamento con più di :max bagni',

            'dimentions.numeric' => 'Le dimensioni devono essere un numero',
            'dimentions.min' => 'Non puoi registrare un appartamento con meno di :min mq',

            'address.required' => 'Il campo indirizzo è obbligatorio',
            'address.min' => 'Il campo indirizzo deve avere almeno :min caratteri',
            'address.max' => 'Il campo indirizzo può avere massimo :max caratteri',

            'city.required' => 'Il campo città è obbligatorio',
            'city.min' => 'Il campo città deve avere almeno :min caratteri',
            'city.max' => 'Il campo città può avere massimo :max caratteri',

            'description.min' => 'Il campo descrizione deve avere almeno :min caratteri',
            'description.max' => 'Il campo descrizione può avere massimo :max caratteri',

            'image.max' => 'Inserisci un file di :max kb',

            'price.required' => 'Il campo prezzo è obbligatorio',
            'price.numeric' => 'Il campo prezzo deve contenere solo numeri',
            'price.max' => 'Il prezzo deve essere inferiore a :max €',
        ];
    }
}
