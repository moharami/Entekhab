<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserDetailsRequest;
use App\Models\UserDetail;
use App\Models\Address;

class UserDetailController extends Controller
{
    public function updateDetails(UpdateUserDetailsRequest $request)
    {
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

        return response()->json([
            'message' => 'User details updated successfully',
            'userDetail' => $userDetail,
            'address' => $address
        ], 200);
    }
}
