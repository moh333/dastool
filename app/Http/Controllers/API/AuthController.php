<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendemail;
use Validator;
use App\Models\User;
use App\Models\Member;


class AuthController extends BaseController
{
    /* Users */
    
    // Users Signup 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'            => 'required',
            'email'           => 'required|email|unique:members',
            'password'        => 'required|min:8',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $data['password']        = Hash::make($request['password']);
        $newmember               = Member::create($data);
        $emptydata               = new \stdClass();
        $emptydata->accesstoken  = $newmember->createToken('LaravelSanctumAuth')->plainTextToken;
        $message                 = 'Registered Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    // Users Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'       => 'required|email',
            'password'    => 'required',
        ]);
        
        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            $message                 = 'Access Data Incorrect';
            return response()->json(['message' => $message,'data' => $emptydata,'code' => '500'],500);
        }

        $user              = $request->user();
        if($user->suspensed == 1 || $user->deleted == 1)
        {
            $accessdata              = new \stdClass();
            $message                 = 'Your account is Suspensed and you cannot login, please contact the administration';
            return response()->json(['message' => $message,'data' => $emptydata,'code' => '500'],500);
        }
        $emptydata->accesstoken  = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $message                 = 'Login Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }

    // Users Logout
    public function logout(Request $request)
    {
        $user   = auth()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        $emptydata =  new \stdClass();
        $message   = 'Successfully logged out';
        return response()->json(['message' => $message,'data' => $emptydata,'code'  => '200',]);
    }
    
}
