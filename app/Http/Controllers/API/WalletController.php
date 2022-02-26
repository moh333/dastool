<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendemail;
use Validator;
use App\Models\User;
use App\Models\Wallet;

class WalletController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Wallet::where('user_id',auth()->user()->id)->where('suspensed',0)->where('deleted',0)->get();
        return response(['message' => '','data' => $wallets,'code' => '200']);
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
            'bank'             => 'required',
            'name'             => 'required',
            'card_number'      => 'required',
            'expired_date'     => 'required',
        ]);

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $data['user_id']         = auth()->user()->id;
        $newwallet               = wallet::create($data);
        $message                 = 'Wallet Added Successfully';
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
        $validator = Validator::make($request->all(),[
            'bank'             => 'required',
            'name'             => 'required',
            'card_number'      => 'required',
            'expired_date'     => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                = $request->all();
        $upwallet            = Wallet::findorfail($id);
        $upwallet->update($data);
        $message                 = 'Wallet Updated Successfully';
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
        $delwallet     = Wallet::where('id',$id)->delete();
        $emptydata     = new \stdClass();
        $message       = 'Wallet Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
}
