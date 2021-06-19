<?php

namespace App\Http\Controllers;

use App\Models\NewUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // return response()->json(['cred'=>$credentials], 200);
        if (Auth::attempt($credentials)) {
            // $token = auth()->user()->createToken('My Token')->accessToken;
            return response()->json(['token' => 'message successful'], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
    public function register(Request $request)
    {
        $success=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        if($success){

            return response()->json(['msg'=>'user has been created successfully'],200);
        }
        else{
            return response()->json(['msg'=>'User could not be created']);
        }
    }
    public function users()
    {
        $users=User::all();
        return response()->json(['users'=>$users], 200);
    }
}
