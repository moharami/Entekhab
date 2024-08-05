<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'mobile' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
