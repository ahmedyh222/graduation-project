<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     public function getUserData($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $userData = [
            'state' => 'good, ok',
            'message' => 'information retreived successfully',
            'data' => [
                'user' => [
                    'user_id' => $user->id,
                    'nick_name' => $user->nick_name,
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
