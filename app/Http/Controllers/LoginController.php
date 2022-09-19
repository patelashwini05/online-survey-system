<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
  public function login(Request $request){
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    if($request->remember_me == true){
        $remember_me = true;
    }
    else{
        $remember_me = false;
    }

    if(Auth::attempt(['email'=>request('email'),'password'=>request('password')], $remember_me)){
        $user = Auth::user();
        $token = $user->createToken('access_token')->accessToken;

        User::where('id',Auth::user()->id)->update([
            'access_token'=>$token,
        ]);

        // After Successfull Authentication
        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'token'     => $token,
            'user'      => $user,
        ]);
    }

    // If Authentication Is Unsuccessfull
    else{
        return response()->json([
            'success'   => Config('constants.inValidResponse.success'),
            'message'   => 'Invalid Email or Password',
        ],Config('constants.invalidToken.statusCode'));
    }
  }

  public function logout(Request $request){
        Auth::user()->token()->delete();

        User::where('id',Auth::user()->id)->update([
            'access_token'=>NUll,
        ]);

        return response()->json([
            'success' => Config('constants.validResponse.success'),
            'message' => 'Logout Successfully.'
        ]);
  }
}
