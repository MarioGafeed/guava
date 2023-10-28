<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'active' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('main.name'),
            'address' => trans('main.address'),
            'phone' => trans('main.phone'),
            'active' => trans('main.active'),
        ];
    }
}
