<?php

namespace App\Http\Controllers;

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


/*        if($request->image) {
            $temp = $request->image;
            $imgname=time().'.'.$temp->getClientOriginalExtension();
            $request->image->move('User', $imgname);
        }*/

/*        ******************** To make all this data optional for user table *********************/
        if($request->province) {
            $uprov = $request->province;
        }
        else {
            $uprov = "none";
        }

        if($request->city) {
            $ucity = $request->city;
        }
        else {
            $ucity = "none";
        }
        if($request->street) {
            $ustreet = $request->street;
        }
        else {
            $ustreet = "none";
        }
        if($request->prefix) {
            $uprefix = $request->prefix;
        }
        else {
            $uprefix = "none";
        }
        if($request->phone) {
            $uphone = $request->phone;
        }
        else {
            $uphone = "none";
        }


        if($request->moreInf) {
            $more = $request->moreInf;
        }
        else {
            $more = 0;
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
           'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'usertype' => $request->usertype,
            'bdate' => $request->bdate,
            'gender' => $request->gender,
            'prefix' => $uprefix,
            'phone' => $uphone,
            'province' => $uprov,
            'city' => $ucity,
            'street' => $ustreet,
            'moreInf'=>$more
/*             'image' =>$imgname*/
        ]);

        if($more == true) {
            if ($request->age) {
                $sage = $request->age;
            } else {
                $sage = "none";
            }
            if ($request->rate) {
                $srate = $request->rate;
            } else {
                $srate = 0;
            }
            if ($request->current_hospital) {
                $scurrent_hospital = $request->current_hospital;
            } else {
                $scurrent_hospital = "none";
            }
            if ($request->graduation_year) {
                $sgraduation_year = $request->graduation_year;
            } else {
                $sgraduation_year = "none";
            }
            if ($request->experience_years) {
                $sexperience_years = $request->experience_years;
            } else {
                $sexperience_years = "none";
            }
            if ($request->experiences) {
                $sexperiences = $request->experiences;
            } else {
                $sexperiences = "none";
            }
            if ($request->about) {
                $sabout = $request->about;
            } else {
                $sabout = "none";
            }
            if ($request->salary) {
                $ssalary = $request->salary;
            } else {
                $ssalary = "none";
            }
            if ($request->certificate_count) {
                $scertificate_count = $request->certificate_count;
            } else {
                $scertificate_count = 0;
            }
            $staff = Staff::create([
                'id' =>5,
                'name' => $data['name'],
                'username' => $data['username'],
                'staff_type' => $request->staff_type,
                'specialty' => $request->specialty,
                'age' => $sage,
                'rate' => $srate,
                'current_hospital' => $scurrent_hospital,
                'graduation_year' => $sgraduation_year,
                'experience_years' => $sexperience_years,
                'experiences' => $sexperiences,
                'about' => $sabout,
                'salary' => $ssalary,
                'certificate_count' => $scertificate_count,
            ]);
            $token = $user->createToken('main')->plainTextToken;
            return response(compact('user', 'token','status','staff'));
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
