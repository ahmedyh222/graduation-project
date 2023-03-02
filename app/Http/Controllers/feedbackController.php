<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Staff;
use App\Models\Feedback;
use Illuminate\Http\Request;

class feedbackController extends Controller
{
    public function filter_feedback($username){


        $userdoc = User::where('username',$username)->first();

        $doctor =  Doctor::where('username',$username)->first();

        $feedback = feedback::where('feedback_to', $doctor->id)->get();
        $res=array();
        foreach ($feedback as $f) {
            $userpat = User::where('id', $f->feedback_from)->first();
            $userData = [
                'state' => 'good, ok',
                'message' => 'information retreived successfully',
                'data' => [
                    'user' => [
                        'feedback_from' => $f->feedback_from,
                        'feedback_to' => $f->feedback_to,
                        'rate' => $f->rate,
                        'issued_time' => $f->updated_at,
                        'feedback' => $f->feedback,
                        'uimgUrl' => $userpat->img_url,
                        'dimgUrl' => $userdoc->img_url,
                        'username' => $userpat->username,
                        'doctorName' => $doctor->name,
                    ]
                ]
            ];
            array_push($res,$userData);

        }
        return response(compact('res'),200);

    }
}
