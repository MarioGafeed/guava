<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'checkin_date' => 'required',
            'appartment_id' => 'required',
            'guest_id' => 'required',
            'active' => 'required',
        ];

        return $return;
    }
}
