<?php

namespace App\Http\Controllers;

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
    }
}
