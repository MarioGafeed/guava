<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppartmentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'hasBeds' => 'required',
            'place_id' => 'required',
            'availableBeds' => 'required',
            'active' => 'required',
        ];

        return $return;
    }
}
