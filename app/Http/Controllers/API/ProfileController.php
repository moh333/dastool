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

class ProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile    = member::where('id',auth()->user()->id)->first();
        return response(['message' => '','data' => $profile,'code' => '200']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auth_user_id = auth()->user()->id;
        $validator = Validator::make($request->all(),[
            'name'       => 'required',
            'email'      => 'required|email|unique:members,email,'.$auth_user_id,
            'password'   => $request->password ? 'required|min:8' : '',
        ]);

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data              = $request->all();
        $userinfo          = Member::where('id',$auth_user_id)->first();
        $data ['password'] = $request->password ? Hash::make($request->password) : $userinfo->password;
        $userinfo->update($data);
        $message           = 'Profile Updated Successfully';
        return response(['message' => $message,'data' => $userinfo,'code' => '200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
