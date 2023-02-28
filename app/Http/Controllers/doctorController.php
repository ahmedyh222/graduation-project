<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class doctorController extends Controller
{
    
    public function getDoctorData($user_id)
    {
        $doctor = Doctor::where('id', $user_id)->first();

        $doctorData = [
            'state' => 'good, ok',
            'message' => 'information retreived successfully',
            'data' => [
                'user' => [
                    'doctor_id' => $doctor->id,
                    'user_name' => $doctor->username,
                    'rate'=>$doctor->rate,
                    'specialty'=>$doctor->specialty,
                    'nick_name'=>$doctor->name,
                    'fees'=>$doctor->salary,
                    'about'=>$doctor->about,
                    'img_urls' => [
                        [
                            'img_url' => $doctor->img_url
                        ]
                    ]
                ]
            ]
        ];

        return response()->json($doctorData);
    }
}
