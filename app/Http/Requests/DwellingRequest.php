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
            'name'=>'required|ming:3|max:255',
            'rooms'=>'numeric|min:1|max:255',
            'beds'=>'numeric|min:1|max:255',
            'bathroom'=>'numeric|min:1|max:255',
            'dimentions'=>'numeric|min:10',
            'address'=>'required|min:1|max:255',
            'city'=>'required|min:1|max:255',
            'description'=>'min1|max:2000',
            'image'=>'max:32000',
            'visible'=>'required',
            'price'=>'required|numeric|max:1000000'
        ];
    }
}
