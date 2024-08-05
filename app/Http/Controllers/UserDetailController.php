<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    public function updateDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'national_id' => 'required|string|unique:user_details,national_id',
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = auth()->user();

        $userDetail = UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            ['national_id' => $request->national_id]
        );


        $address = Address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]
        );

        return response()->json(['message' => 'User details updated successfully'], 200);
    }
}