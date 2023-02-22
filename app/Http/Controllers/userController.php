<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function get_doctors(){
        $doctors=Staff::all();
        return response(compact('doctors'));
    }
}
