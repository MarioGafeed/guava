<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $return = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed',
            'type' => 'required|in:user,admin',
            'image' => 'required|mimes:jpg',
        ];

        if (in_array($this->method(), ['POST', 'PATCH'])) {
            $return['email'] = 'required|unique:users,email,'.$this->route()->parameter('user').',id';
            $return['phone'] = 'required|unique:users,phone,'.$this->route()->parameter('user').',id';
        }

        return $return;
    }

    public function attributes()
    {
        return [
            'name' => trans('main.name'),
            'email' => trans('main.email'),
            'password' => trans('main.password'),
            'type' => trans('main.type'),
        ];
    }
}
