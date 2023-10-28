<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkplacesRequest extends FormRequest
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
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('main.name'),
            'address' => trans('main.address'),
        ];
    }
}
