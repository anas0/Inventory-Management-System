<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userRegistration(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required',
                'mobile' => 'nullable',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Registration Successful',
                'data' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "User Registration Failed"
            ]);
        }
    } //End Method

    public function userLogin(Request $request)
    {
        $count = User::where("email", $request->input("email"))->where('password', $request->input('password'))->select('id')->first();

        if ($count !== null) {
            //User Login -> JWT Token issue
            $token = JWTToken::createToken($request->input('email'), $count->id);

            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successfull',
                'token' => $token,
            ], 200)->cookie('token', $token, time() + 60);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => 'User Login Failed',
            ], 200);
        }
    } //End Method

    public function userLogout(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'User Logout Successfully',
        ], 200)->cookie('token', '', -1);
    } //End Method
}
