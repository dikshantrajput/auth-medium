<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getData(Request $request){
        $user_id = $request->id;
        $user = User::find($user_id)->first(['name','email','mobile']);
        // $user = auth()->user();
        return view('users.data',compact('user'));
    }

    public function ageRestrictedPage(){
        $age = Carbon::parse(auth()->user()->dob)->age;
        return 'You can view this page because your age is ' . $age;
    }
}
