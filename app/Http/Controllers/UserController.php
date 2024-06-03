<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller

{//validation of input
    public function store(Request $request){
        //validation of input
        $validator = Validator::make ($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email|max:255, string',
            'phone' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'password' => 'required|min:6|max:40',
            'confirm_password' => 'required|min:6|max:40|same:password',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $save=$user->save();
        if ($save){
            return redirect()->route('login')->with('message', 'Registration Successful');
        }else{
            return redirect()->back()->with('error', 'Registration Failed');
        }
        
    }

    //logout
    public function user_logout() {
        Auth::guard('web')-> logout();
        return redirect('/')->with('message', 'You are logged out');
    }
}
