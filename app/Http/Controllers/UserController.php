<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list(){
        $list = User::get();
        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got user list successfully.',
            'data'      => $list
        ],Config('constants.validResponse.statusCode'));
    }

    public function add(Request $request){
        $validator = validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'user_type' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],401);
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'status' => $request->status
        ]);

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'User added successfully.',
        ],Config('constants.validResponse.statusCode'));
    }

    public function edit(Request $request){
        $userdetails = User::where('id',$request->id)->first();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got user details successfully.',
            'data' => $userdetails
        ],Config('constants.validResponse.statusCode'));

    }

    public function update(Request $request){
        $validator = validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
            'user_type' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],401);
        }

        User::where('id',$request->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'status' => $request->status
        ]);

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'User updated successfully.',
        ],Config('constants.validResponse.statusCode'));
    }

    public function delete(Request $request){
        $user = User::where('id',$request->id)->delete();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'User deleted successfully.',
        ],Config('constants.validResponse.statusCode'));
    }
}
