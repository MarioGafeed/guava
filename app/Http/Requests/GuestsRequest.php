<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestsRequest extends FormRequest
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
            'identity' => 'required',
            'active' => 'required',
            'image' => 'nullable|mimes:jpg',
        ];

        if (in_array($this->method(), ['POST', 'PATCH'])) {
            $return['identity'] = 'required|unique:guests,identity,'.$this->route()->parameter('user').',id';
            $return['phone'] = 'required|unique:guests,phone,'.$this->route()->parameter('guest').',id';
        }

        return $return;
    }
}
