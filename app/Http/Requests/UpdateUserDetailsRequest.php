<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust if you want to handle authorization
    }

    public function rules()
    {
        $userId = $this->user()->id; // Get the currently authenticated user ID

        return [
            'national_id' => [
                'required',
                'string',
                // Exclude the current user's national_id from uniqueness check
                'unique:user_details,national_id,' . $userId . ',user_id',
            ],
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ];
    }
}
