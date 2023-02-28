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
            $status=400;
            $msg="Sorry! choose another username";
            return response(compact( 'status','msg'));
        }

        $status=200;
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
            return response(compact('user', 'token','status','doctors'));
        }
        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user', 'token','status'));
    }

    public function login(Request $request){
        $username=$request->username;


        /*        return response(compact('username'));*/

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            /*            $request->session()->regenerate();*/

            $status=200;

            Auth::loginUsingId(1);

            $user=User::where('username',$username)->first();
            return response(compact('status','user'));
        }
        $msg="Incorrect username or password";
        $status=400;
        return response(compact('status','msg'));

    }
}
