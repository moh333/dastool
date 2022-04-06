<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendemail;
use Validator;
use App\Models\User;
use App\Models\User_email;


class EmailController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_emails = User_email::where('user_id',auth()->user()->id)->where('deleted',0)->get();
        return response(['message' => '','data' => $user_emails,'code' => '200']);
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
        $validator = Validator::make($request->all(),[
            'name'     => 'required',
            'to'       => 'required|email',
            'subject'  => 'required',
            'message'  => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }

        $data            = $request->all();
        $data['user_id'] = auth()->user()->id;
        User_email::create($data);
        Mail::to($request->to)->send(new sendemail($request->to,auth()->user()->email,$request->subject,$request->message));
        $message       = 'Email has been sent successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
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
        //
    }

    public function readed(Request $request, $id)
    {
        User_email::findorfail($id)->update(['readed' => 1]);
        $emptydata               = new \stdClass();
        $message                 = 'Email Readed Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }

    public function archieved(Request $request, $id)
    {
        User_email::findorfail($id)->update(['archived' => 1]);
        $emptydata               = new \stdClass();
        $message                 = 'Email Archived Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delEmail    = User_email::where('id',$id)->delete();
        $emptydata   = new \stdClass();
        $message     = 'Email Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
}
