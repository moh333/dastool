<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendemail;
use Validator;
use App\Models\User;
use App\Models\Contact;
use App\Models\Contact_address;
use App\Models\Contact_socialmedia;
use App\Models\Contact_miscellaneous;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Contacts = Contact::with('contactaddress')->with('contactsocialmedia')->with('contactmiscellaneous')->get();
        return response(['message' => '','data' => $Contacts,'code' => '200']);
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
            'firstname'            => 'required',
            'lastname'             => 'required',
            'email'                => 'required',
            'phone'                => 'required',
            'dob'                  => 'required',
            'companyname'          => 'required',
            'gender'               => 'required',
            'salutation'           => 'required',
        ]);

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $data['user_id']         = auth()->user()->id;
        $newContact              = Contact::create($data);

        $data['contact_id']      = $newContact->id;
        $newaddress              = Contact_address::create($data);
        $newsocialmedia          = Contact_socialmedia::create($data);
        $newaddress              = Contact_miscellaneous::create($data);

        $message                 = 'Contact Added Successfully';
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
            'firstname'            => 'required',
            'lastname'             => 'required',
            'email'                => 'required',
            'phone'                => 'required',
            'dob'                  => 'required',
            'companyname'          => 'required',
            'gender'               => 'required',
            'salutation'           => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $upContact               = Contact::findorfail($id);
        $upContact->update($data);

        $upaddress              = Contact_address::where('contact_id',$upContact->id)->first();
        $upaddress->update($data);

        $upsocialmedia          = Contact_socialmedia::where('contact_id',$upContact->id)->first();
        $upsocialmedia->update($data);

        $upaddress              = Contact_miscellaneous::where('contact_id',$upContact->id)->first();
        $upaddress->update($data);

        $message                 = 'Contact Updated Successfully';
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
        $delContact     = Contact::where('id',$id)->delete();
        $emptydata   = new \stdClass();
        $message     = 'Contact Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
}
