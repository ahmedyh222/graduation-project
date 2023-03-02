<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class userController extends Controller
{
  public function getUserData($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $userData = [
            'state' => 'good, ok',
            'message' => 'information retreived successfully',
            'data' => [
                'user' => [
                    'user_id' => $user->id,
                    'nick_name' => $user->name,
                    'user_type' => $user->user_type,
                    'bdate' => $user->bdate,
                    'gender' => $user->gender,
                    'prefix' => $user->prefix,
                    'pnumber' => $user->pnumber,
                    'email' => $user->email,
                    'province' => $user->province,
                    'city' => $user->city,
                    'street' => $user->street,
                    'img_url' => $user->img_url,
                    'age' => $user->age,
                    'img_urls' => [
                        [
                            'img_url' => $user->img_url
                        ]
                    ]
                ]
            ]
        ];

        return response()->json($userData);
    }
}
