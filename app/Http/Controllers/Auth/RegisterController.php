<?php

namespace App\Http\Controllers\Auth;

use App\member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, 
        [
            'firstname'     => ['required', 'string', 'max:255'],
            'lastname'     => ['required', 'string', 'max:255'],
            'phone'    => ['required','digits_between:10,20', 'unique:members'],
            'email'  => ['required','email','unique:members'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'firstname.required'    => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'lastname.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'phone.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'phone.unique'          => session('locale') == 'en' ?  'The :attribute has already been taken.'         : 'تم اخذ رقم الجوال سابقا',
            'email.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'email.unique'          => session('locale') == 'en' ?  'The :attribute has already been taken.'         : 'تم اخذ البريد الإلكترونى سابقا',
            'password.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'password.min'          => session('locale') == 'en' ?  'The :attribute must be at least :min.'          : ' كلمة المرور لا تقل عن 8 احرف', 
            'password.confirmed'    => session('locale') == 'en' ?  'The :attribute confirmation does not match.'    : 'كلمة المرور غير متطابقة', 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\member
     */
    protected function create(array $data)
    {
        return member::create([
            'login_type'  => 'email',
            'firstname'    => $data['firstname'],
            'lastname'     => $data['lastname'],
            'email'        => $data['email'],
            'phone'        => $data['phone'],
            'password'     => Hash::make($data['password']),
        ]);
    }
}
