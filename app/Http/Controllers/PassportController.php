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

        if (Auth::attempt($credentials)) {
            // $token = auth()->user()->createToken('My Token')->accessToken;
            return response()->json(['msg' => "user is logged in"], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
    public function register(Request $request)
    {

        if($request->password==$request->confirmed_password)
        {
            $success=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
            if($success){

                return response()->json(['msg'=>'user has been created successfully'],200);
            }
            else{
                return response()->json(['msg'=>'User could not be created']);
            }
        }


            else{
                return response()->json(['msg'=>'password does not match']);
            }


    }
    public function users()
    {
        $users=User::all();
        return response()->json(['users'=>$users], 200);
    }
}
