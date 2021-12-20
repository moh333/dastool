<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Spatie\SslCertificate\SslCertificate;
use App\Mail\sendemail;
use Carbon\Carbon;
use App\member;
use App\board;
use App\task;
use App\assignment;
use App\wallet;
use DB;


class ApiController extends Controller
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
        $newmember               = member::create($data);
        $emptydata               = new \stdClass();
        $emptydata->accesstoken  = $newmember->createToken('authToken')->accessToken;
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
        $emptydata->accesstoken  = auth()->user()->createToken('authToken')->accessToken;
        $message                 = 'Login Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    // update user profile
    public function updateprofile(Request $request)
    {
        $auth_user_id = auth()->user()->id;
        $validator = Validator::make($request->all(),[
            'name'       => 'required',
            'email'      => 'required|email|unique:members,email,'.$auth_user_id,
        ]);

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data     = $request->all();
        $userinfo = member::where('id',$auth_user_id)->first();
        $userinfo->update($data);
        $message    = 'Profile Updated Successfully';
        return response(['message' => $message,'data' => $userinfo,'code' => '200']);
    }
    
    // Change Password In Profile
    public function changepassword(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'password'        => 'required|min:8',
        ]); 

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $user           = member::where('id',auth()->user()->id)->first();
        if(Hash::check($request->oldPassword , $user->password))
        {
            $user->password =  Hash::make($request['password']);
            $user->save();
            $message        = 'Password Changed Successfully';
            return response(['message' => $message,'data' => $emptydata,'code' => '200']);
        }else
        {
           $message                 = 'Old Password Not Matching With Current Password';
           return response(['message' => $message,'data' => $emptydata,'code' => '200']);
        }
    }
    
    // Users Logout
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $emptydata =  new \stdClass();
        $message   = 'Successfully logged out';
        return response()->json(['message' => $message,'data' => $emptydata,'code'  => '200',]);
    }
    
    // User profile
    public function profile(Request $request)
    {
        $profile    = member::where('id',auth()->user()->id)->first();
        return response(['message' => '','data' => $profile,'code' => '200']);
    }
    
    
    /* boards */
    
    public function boards(Request $request)
    {
        $boards = board::where('user_id',auth()->user()->id)->where('suspensed',0)->where('deleted',0)->get();
        return response(['message' => '','data' => $boards,'code' => '200']);
    }
    
    public function addboard(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'            => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $data['user_id']         = auth()->user()->id;
        $newboard                = board::create($data);
        $message                 = 'Board Added Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function editboard(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'            => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $upboard                 = board::findorfail($request->id);
        $upboard->update($data);
        $message                 = 'Board Updated Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function deleteboard(Request $request)
    {
        $delboard    = board::where('id',$request->id)->delete();
        $emptydata   =  new \stdClass();
        $message     = 'Board Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    
    /* tasks */
    
    public function tasks(Request $request)
    {
        $tasks = task::with('Assignments')->where('board',$request->board)->where('suspensed',0)->where('deleted',0)->get();
        return response(['message' => '','data' => $tasks,'code' => '200']);
    }
    
    public function addtask(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'board'            => 'required',
            'title'            => 'required',
        ]);

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $newtask                 = task::create($data);
        $message                 = 'Task Added Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function edittask(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'            => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $uptask                  = task::findorfail($request->id);
        $uptask->update($data);
        $message                 = 'Task Updated Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function deletetask(Request $request)
    {
        $deltask     = task::where('id',$request->id)->delete();
        $emptydata   =  new \stdClass();
        $message     = 'Task Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    /* Assignments */
    
    public function addassignment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'task'            => 'required',
            'title'           => 'required',
            'description'     => 'required',
        ]);

        $emptydata =  new \stdClass();
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $newassignment           = assignment::create($data);
        $message                 = 'Assignment Added Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function editassignment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'           => 'required',
            'description'     => 'required',
        ]);

        $emptydata =  new \stdClass();
        
        if($validator->fails())
        {
            return response(['message' => $validator->errors()->first(),'data' => $emptydata,'code' => '500'],500);    
        }
        
        $data                    = $request->all();
        $upassignment            = assignment::findorfail($request->id);
        $upassignment->update($data);
        $message                 = 'Assignment Updated Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function deleteassignment(Request $request)
    {
        $delassignment = assignment::where('id',$request->id)->delete();
        $emptydata     = new \stdClass();
        $message       = 'Assignment Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    /* wallets */
    
    public function wallets(Request $request)
    {
        $wallets = wallet::where('user_id',auth()->user()->id)->where('suspensed',0)->where('deleted',0)->get();
        return response(['message' => '','data' => $wallets,'code' => '200']);
    }
    
    public function addwallet(Request $request)
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
    
    public function editwallet(Request $request)
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
        $upwallet            = wallet::findorfail($request->id);
        $upwallet->update($data);
        $message                 = 'Wallet Updated Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
    public function deletewallet(Request $request)
    {
        $delwallet = wallet::where('id',$request->id)->delete();
        $emptydata     = new \stdClass();
        $message       = 'Wallet Deleted Successfully';
        return response(['message' => $message,'data' => $emptydata,'code' => '200']);
    }
    
}