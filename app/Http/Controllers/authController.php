<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function check_user($username){
        $users = User::where('username',$username)->first();
        /*        return response(compact('users'));*/

        if(!$users){
            $isExist=1;
            $status=400;
            return response(compact('isExist', 'status'));
        }

        $isExist=0;
        $status=200;
        return response(compact('isExist', 'status'));
    }


    public function adduser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',

        ]);
        $username = $request->username;
        $users = User::where('username',$username)->first();

        if($users){
            $state="bad request";
            $message="inf. not found";
            $data = [
                'err' => [
                'code' => "ER_DUP_ENTRY"
                ]

            ];
            return response(compact('state','message','data'),400);
        }

        $state="good, ok";
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'user_type' => $request->usertype,
            'bdate' => $request->bdate,
            'gender' => $request->gender,
            'prefix' =>  $request->prefix,
            'phone' => $request->phone,
            'province' => $request->province,
            'city' => $request->city,
            'street' => $request->street,
            'moreInf'=>$request->moreInf,
            'img_url' =>$request->img_url
        ]);

        if($request->moreInf == true) {

            $data = User::where('username',$username)->first();
            $user_id=$data->id;

            $doctors = Doctor::create([
                'name' => $data['name'],
                'user_id'=>$user_id,
                'username' => $data['username'],
                'staff_type' => $request->staff_type,
                'specialty' => $request->specialty,
                'age' => $request->age,
                'num_rate' => $request->num_rate,
                'rate' => $request->rate,
                'current_hospital' => $request->current_hospital,
                'graduation_year' => $request->graduation_year,
                'experience_years' => $request->experience_years,
                'experiences' => $request->experiences,
                'about' => $request->about,
                'salary' => $request->salary,
                'certificate_count' => $request->certificate_count,
            ]);
            $token = $user->createToken('main')->plainTextToken;
            $message="information retreived successfully";
            $data = [
                'user_id'=>$user_id
                ];

            return response(compact('state', 'message','data'),200);
        }
        $message="information retreived successfully";
        $token = $user->createToken('main')->plainTextToken;
        return response(compact('state', 'message','data'),200);
    }
/*
 * ******************************************** login ********************************************
 */
    public function login(Request $request){
        $username=$request->username;

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $state= "good, ok";
            $message= "information retreived successfully";
            Auth::loginUsingId(1);
            $user = User::where('username',$username)->first();
            $user_id=$user->id;
            $data = [
                'isVerified'=>1,
                "user_id"=> $user_id
            ];
            return response(compact('state','message','data'),200);
        }
        $user = User::where('username',$username)->first();
        if(!$user) {
            $state = "bad request";
            $message = "Incorrect username";
            $data = [
                'isExist'=>0
            ];
            return response(compact('state', 'message','data'),400);
        }
        $state = "bad request";
        $message = "Incorrect password";
        $data = [
            'isVerified'=>0
        ];
        return response(compact('state', 'message','data'),400);
    }
}
