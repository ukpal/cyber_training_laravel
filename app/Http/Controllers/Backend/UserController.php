<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use Session;
// use DB;

use Mail;
use App\Mail\AppEmail;
use PDF;

use \App\Models\User\Authentication;
use \App\Models\User\UserProfile;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public $successStatus = 200;
    protected $auth;

    public function __construct()
    {
        $this->auth = new Authentication();
    }


    //login
    public function login(Request $request)
    {
        if ($request->session()->has('admin')) {
            return redirect('/dashboard');
        }
        return view('backend.user.login', [
            'phone' => '',
            'error' => false,
            'error_message' => ''
        ]);
    }

    //authenticate admin
    public function authenticate(Request $request)
    {
        $now            =    date('Y-m-d H:i:s');
        $today          =    date('Y-m-d');
        $input          =    $request->all();
        $otp_send       =    false;
        $error_message  =    '';

        $username       =    $input['username'];

        //generate otp
        $otp = generateOTP();
        $token = encrypt_password(md5($otp . $now));

        //get last otp details
        if (DB::table('users')->where('email', $username)->orWhere('phone', $username)->where('is_active', 1)->exists()) {
            //get last otp details
            if (DB::table('otp')->where('username', $username)->exists()) {
                $otp_res = DB::table('otp')->where('username', $username)->first();

                $last_otp_date = substr(trim($otp_res->otp_created_on), 0, 10);

                if ($last_otp_date == $today) {
                    $minutes = getTimeDiffInMinute($now, $otp_res->otp_created_on);
                    if ($otp_res->otp_count < 5) {
                        if ($minutes > 5) {
                            DB::table('otp')->where('username', $username)->delete();
                            DB::table('otp')->insert(
                                [
                                    'username' => $username, 'token' => $token, 'otp' => $otp,
                                    'otp_created_on' => $now, 'otp_count' => intval($otp_res->otp_count) + 1
                                ]
                            );
                            $otp_send = true;
                        } else {
                            $error_message = "Your previous OTP was generated in last 5 minutes";
                        }
                    } else {
                        $error_message = "You exceed the OTP generation limit for today. Try again tomorrow.";
                    }
                } else {
                    //SEND OTP reseting counter to 1
                    DB::table('otp')->where('username', $username)->delete();
                    DB::table('otp')->insert(
                        [
                            'username' => $username, 'token' => $token, 'otp' => $otp,
                            'otp_created_on' => $now, 'otp_count' => 1
                        ]
                    );
                    $otp_send = true;
                }
            } else {
                $otp_send = true;
                DB::table('otp')->insert(
                    ['username' => $username, 'token' => $token, 'otp' => $otp, 'otp_created_on' => $now, 'otp_count' => 1]
                );
            }
        } else {
            $error_message = "Either email address/phone number is not registered or your profile is not activated.";
        }

        if ($otp_send) {
            $res = DB::table('users')->where('email', $username)->orWhere('phone', $username)->first();

            $phone = $res->phone;
            $email = $res->email;

            //update token
            DB::table('users')->where('email', $email)->where('phone', $phone)->update(['token' => $token]);

            //send OTP
            $sms_message = "Your Cyber Yoddha authentication code: " . $otp;
            initiateSmsActivation($phone, $sms_message, 'AUTH_OTP');
            //generate email data
            $email_data = [
                'email_for'         =>  "email_login_otp",
                'email_subject'     =>  "One Time Password - Cyber Yoddha",
                'email_otp'         =>  $otp
            ];

            Mail::to($email)->send(new AppEmail($email_data));

            return view('backend.user.otp', [
                'email' => $email,
                'phone' => $phone,
                'token' => $token,
                'error' => ($otp_send) ? false : true,
                'error_message' => ($otp_send) ? '' : $error_message,
                'otp' => env('APP_DEBUG') ? $otp : '',
            ]);
        } else {
            return view('backend.user.otp', [
                'username' => $username,
                'error' => ($otp_send) ? false : true,
                'error_message' => ($otp_send) ? '' : $error_message
            ]);
        }
    }  

    //verify otp
    public function verify_otp(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $input      =    $request->all();

        $otp        =    $input['otp'];
        $token      =    $input['token'];

        $admin = null;

        $admin_otp = DB::table('otp')->where('token', $token)
            ->where('otp', $otp)->first();


        if ($admin_otp != null) { //valid otp
            $admin = UserProfile::where('token', $token)->first();

            $auth_user    =    $this->auth->authenticate($token);
            //remove from otp table
            DB::table('otp')->where('token', $token)->delete();

            if (is_null($auth_user)) {
                return redirect('/login')->with('message', 'error|Unable to verify');
            } else {
                if(count($auth_user) == 2){
                    return view('backend.user.login_as', [
                        'data' => $auth_user,
                    ]);
                }else{
                    Session::put('admin', $auth_user);
                    return redirect('/dashboard');
                }
                
            }
        } else {
            return redirect('/login')->with('message', 'error|Unable to verify submitted OTP');
        }
    }

    public function login_as(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $input      =    $request->all();

        $id        =    $input['role'];
        $token        =    $input['token'];

        $admin = null;

        if ($id != null) { //valid otp
            $admin = UserProfile::where('token', $token)->where('id',$id)->first();

            $auth_user    =    $this->auth->authenticate_one($id);
            //remove from otp table
            DB::table('otp')->where('token', $token)->delete();

            if (is_null($auth_user)) {
                return redirect('/login')->with('message', 'error|Unable to verify');
            } else {
                Session::put('admin', $auth_user);
                return redirect('/dashboard');                
            }
        } else {
            return redirect('/login')->with('message', 'error|Unable to verify submitted OTP');
        }
    }



    //logout
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    //dashboard
    public function dashboard(Request $request)
    {
        if (!$request->session()->has('admin')) {
            return redirect('/login');
        }

        return view(
            'backend.user.dashboard',
            [
                'module'        =>    'dashboard'
            ]
        );
    }

    //members
    public function members(Request $request, $type)
    {   
        // if(Session::get('admin')['sess_role_name'] == 'director'){
        //     $members = DB::table('users')->where('role',$type)->orderBy('id', 'ASC')->get();
        // }else{
        //     $members = DB::table('users')->where('role', $type)->where('id',Session::get('admin')['sess_admin_id'])->orderBy('fullname', 'ASC')->get();
        // }        
        $members = DB::table('users')->where('role',$type)->orderBy('id', 'ASC')->get();
        return view(
            'backend.user.members_list',
            [
                'module'    =>  $type,
                'members'   =>  $members
            ]
        );
    }

    public function add_member(Request $request,$module)
    {
        
        return view(
            'backend.user.add_members',
            [
                'module'    =>  $module
            ]
        );
    }

    public function save_member(Request $r,$type){

        $input = $r->all();
        for ($i=0; $i < count($input['role']) ; $i++) { 
            $data = [
                'fullname'          => strtoupper($input['fullnm']),
                'token'             => '',
                'phone'             => $input['mobile'],
                'email'             => $input['email'],
                'designation'       => strtoupper($input['designation']),
                'organisation'      => strtoupper($input['organisation']),
                'role'              => $input['role'][$i]
            ]; 
            $save = DB::table('users')->insert($data);           
        }        
        
        if($save){
            $members = DB::table('users')->where('role', 'like','%'.$type.'%')->orderBy('fullname', 'ASC')->get();
        
            return view(
                'backend.user.members_list',
                [
                    'module'    =>  $type,
                    'members'   =>  $members
                ]
            );
        }else{
            return view(
                'backend.user.add_members',
                [
                    'module'    =>  $type
                ]
            );
        }
    }

    //yoddha_list
    public function yoddha_registered(Request $request, $status = 'pending') {
        $yoddhas = null;
        if($status == 'all') {
            $yoddhas = DB::table('yoddha_registrations')->orderBy('id', 'DESC')->get();
        }
        else {
            $yoddhas = DB::table('yoddha_registrations')->where('status', $status)->orderBy('id', 'DESC')->get();
        }
        
        return view(
            'backend.user.yoddhas_list',
            [
                'module'    =>  'yoddha-registered',
                'yoddhas'   =>  $yoddhas,
                'status'    =>  $status
            ]
        );
    }

    // Yoddha Details
    public function yoddha_details(Request $request,$id) {
        
        $yoddhas = DB::table('yoddha_registrations')->where('id', $id)->first();

        $scutiny = DB::table('yoddha_scutiny')
                ->join('users', 'users.id', '=', 'yoddha_scutiny.user_id')
                ->select('users.fullname', 'yoddha_scutiny.*')
                ->where('yoddha_scutiny.yoddha_id', $id)
                ->get()->toArray();
        return view(
            'backend.user.yoddha_details',
            [
                'module'    =>  'yoddha-details',
                'yoddha'   =>  $yoddhas,
                'scutiny'  => $scutiny
            ]
        );
    }

    // Approved Reject

    public function update_status(Request $request) {
        $input = $request->all(); 
        $id = $input['c_id'];
        $status = $input['btn_status'];

        DB::beginTransaction();
        try{
            $record = DB::table('yoddha_registrations')->where('id',$id)->first();
            if ($status == 'approved') {
                $data = [
                    'fullname'          => strtoupper($record->c_name),
                    'yoddha_reg_id'     =>$id,
                    'token'             => '',
                    'phone'             => $record->c_phone_no,
                    'email'             => $record->c_email,
                    'designation'       => strtoupper($record->cand_step),
                    'organisation'      => strtoupper($record->c_org),
                    'role'              => 'yoddha-member',
                    'y_status'          =>$status
                ];

                $save = DB::table('yoddha_team')->insert($data);
                DB::table('yoddha_registrations')->where('id', $id)->update(['status' => $status]);
            }else{
                DB::table('yoddha_registrations')->where('id', $id)->update(['status' => $status]);
            }            
            DB::commit();
            return redirect('/yoddha-registered/'.$status)->with('message','success|status updated');
        }catch(Exception $e){
            DB::rollback();
            return redirect('/yoddha-details')->with('message','error|Unable to Update');
        }        
    }

    //yoddha team list
    public function yoddha_team(Request $request) {
        $yoddhas = DB::table('yoddha_team')->where('y_status','approved')->orderBy('id', 'DESC')->get();        
        
        return view(
            'backend.user.yoddhas_team',
            [
                'module'    =>  'yoddha-team',
                'yoddhas'   =>  $yoddhas
            ]
        );
    }

    //yoddha scrutiny

    public function yoddha_scrutiny(Request $request,$status = 'all'){
        $yoddhas = null;
        if($status == 'all') {
            $yoddhas = DB::table('yoddha_registrations')->orderBy('id', 'DESC')->get();
        }
        else {
            $yoddhas = DB::table('yoddha_registrations')->where('status', $status)->orderBy('id', 'DESC')->get();
        }

        return view(
            'backend.user.yoddhas_scrutiny',
            [
                'module'    =>  'yoddha-scrutiny',
                'yoddhas'   =>  $yoddhas,
                'status'    =>  $status
            ]
        );
    }

    public function yoddha_details_scrutiny(Request $request,$id) {
        
        $yoddhas = DB::table('yoddha_registrations')->where('id', $id)->first();

        $scutiny = DB::table('yoddha_scutiny')->where('yoddha_id', $id)->where('user_id',Session::get('admin')['sess_admin_id'])->first();
        //print_r($scutiny);exit();
        
        return view(
            'backend.user.yoddha_details_scrutiny',
            [
                'module'    =>  'yoddha-details-scrutiny',
                'yoddha'   =>  $yoddhas,
                'scutiny'  => $scutiny
            ]
        );
    }

    public function scrutiny_status(Request $request) {

        $input = $request->all(); 
        $id = $input['yoddha_reg_id'];
        $status = $input['s_status'];
        $remarks = $input['s_remarks'];

        //print_r($input);
        $data = [
            'yoddha_id'     => $id,
            'user_id'       => Session::get('admin')['sess_admin_id'],
            's_status'      => $status,
            's_remarks'     => $remarks
        ];

        $save = DB::table('yoddha_scutiny')->insert($data);

        if($save){
            return redirect('/yoddha-details-scrutiny/'.$id.'')->with('message','success|Successfully Update');
        }else{
            return redirect('/yoddha-details-scrutiny')->with('message','error|Unable to Update');
        } 
    }

    public function spoc_change(Request $request){
        date_default_timezone_set('Asia/Kolkata');

        $id = $request->input('id');
        $curr_spoc = DB::table('yoddha_team')->where('id',$id)->first();
        $past_spoc = DB::table('yoddha_team')->where('role','spoc')->first();

        $data = [
            'spoc_yoddha_team_id'=>$curr_spoc->id,
            'spoc_yoddha_reg_id'=>$curr_spoc->yoddha_reg_id,
            'spoc_nm'=>$curr_spoc->fullname,
            'spoc_start_dt'=> date('Y-m-d'),
            'create_by'=> Session::get('admin')['sess_admin_id']
        ];

        if(empty($past_spoc)){
            DB::table('yoddha_team')->where('id', $id)->update(['role' => 'spoc']);            
            DB::table('yoddha_spoc')->insert($data);
        }else{
            $last_spoc = DB::table('yoddha_spoc')->orderBy('spoc_id','DESC')->limit(1)->first();    
            $save = DB::table('yoddha_spoc')->insert($data);
            if($save){
                DB::table('yoddha_spoc')->where('spoc_id', $last_spoc->spoc_id)->update(['spoc_end_dt' => date('Y-m-d'), 'edit_by'=>Session::get('admin')['sess_admin_id'], 'edit_date'=>date('Y-m-d H:i:s')]);
                DB::table('yoddha_team')->where('role', 'spoc')->update(['role' => 'yoddha-member']);
                DB::table('yoddha_team')->where('id', $id)->update(['role' => 'spoc']);
            }
        }
        
        return response()->json(['type'=>'success','title'=>'Done','text'=>'SPoC successfully Changed']); 
    }



    //SPOC List Details

    public function spoc_details(Request $request){
        $spoc = DB::table('yoddha_spoc AS a')
            ->join('yoddha_team AS b', 'b.id', '=', 'a.spoc_yoddha_team_id')
            ->select('b.fullname','b.phone','b.email','b.organisation','b.is_active', 'a.*')
            ->orderBy('id','DESC')->get();

        return view(
            'backend.user.spoc_list',
            [
                'module'    =>  'spoc',
                'spoc'   =>  $spoc
            ]
        );
    }

    public function deactivateYoddha($id){
        // echo $id=decrypt($id);
        try {
            $id=decrypt($id);
            DB::table('yoddha_team')->where('id',$id)->update(['is_active'=>0]);
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect('yoddha-team');
        }
        
    }
    public function activateYoddha($id){
        // echo $id=decrypt($id);
        try {
            $id=decrypt($id);
            DB::table('yoddha_team')->where('id',$id)->update(['is_active'=>1]);
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect('yoddha-team');
        }
        
    }

    public function myProfile(Request $request){
        $id=Session::get('admin')['sess_admin_id'];
        //   echo Session::get('admin')['sess_role_name']; exit();
        if(Session::get('admin')['sess_role_name']=='spoc' || Session::get('admin')['sess_role_name']=='yoddha-member'){
            $data=DB::table('yoddha_team')->where('id',$id)->first();
        }else{
            $data=DB::table('users')->where('id',$id)->first();
        }
        
        return view('backend.user.my_profile',[
            'module'=>'my-profile',
            'data'=>$data
        ]);
    }

    public function updateMember(Request $request){
        if($request->method()=='POST'){
            $update=DB::table('users')->where('id',$request->id)->update($request->except(["_token"]));
            if($update){
                return redirect()->back()->with('message', 'success|Member Updated Successfully');
            }else{
                return redirect()->back()->with('message', 'error|Something Went Wrong');
            }
        }else{
            if(empty($request->id)){
                return redirect()->back();              
            }else{
                $id=decrypt($request->id);
                return view('backend.user.edit_member',[
                    'module'=>'edit-member',
                    'data'=>DB::table('users')->where('id',$id)->first()
                ]);
            }
        }
    }
}
?>