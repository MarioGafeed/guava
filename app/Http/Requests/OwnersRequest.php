<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'active' => 'required',
            'image' => 'nullable|mimes:jpg',
        ];

        if (in_array($this->method(), ['POST', 'PATCH'])) {

            $return['phone'] = 'required|unique:owners,phone,'.$this->route()->parameter('owner').',id';
        }

        return $return;
    }

    public function attributes()
    {
        return [
            'name' => trans('main.name'),
            'phone' => trans('main.phone'),
            'image' => trans('main.image'),
            'active' => trans('main.active'),
        ];
    }
}
