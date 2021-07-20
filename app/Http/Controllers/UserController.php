<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getData(Request $request){
        $user_id = $request->id;
        $user = User::find($user_id)->first(['name','email','mobile']);
        // $user = auth()->user();
        return view('users.data',compact('user'));
    }
}
