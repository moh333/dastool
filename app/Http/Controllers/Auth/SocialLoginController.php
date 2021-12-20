<?php

namespace App\Http\Controllers\Auth;

use App\member;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToSocial($social)
    {
        return Socialite::with($social)->redirect();
    }


    function handleSocialCallback($social)
    {        
        try {
    
            $user     = Socialite::driver($social)->user();
            $finduser = member::where('email', $user->email)->first();
     
            if($finduser){
                 auth()->login($finduser);
                return redirect('/');
            }else{
                $newUser = member::create([
                    'firstname'  => $user->name,
                    'lastname'   => '',
                    'email'      => $user->email,
                    'login_type' => $social,
                    'password'   => encrypt('123456789')
                ]);
    
                auth()->login($newUser);
                return redirect('/');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}