<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorisationRequest extends FormRequest
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
            'dwelling_id'=> 'numeric|min:1',
            'amount'=> 'numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
            'dwelling_id.min' => 'Seleziona un appartamento',
            'amount.min' => 'Seleziona una sponsorizzazione'
        ];
    }
}
