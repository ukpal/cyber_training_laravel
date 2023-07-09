<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use Session;
// use DB;

// use Mail;
use App\Mail\AppEmail;
use PDF;

use \App\Models\yoddha\Authentication;
use \App\Models\yoddha\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class YoddhaController extends Controller
{
    public $successStatus = 200;
    protected $auth;

    public function __construct()
    {
        $this->auth = new Authentication();
    }

    //register
    public function register(Request $request)
    {
        return view('frontend.yoddha.new_register', [
            'phone' => '',
            'error' => false,
            'error_message' => ''
        ]);
    }

    //login
    public function login(Request $request)
    {
        if ($request->session()->has('admin')) {
            return redirect('/cyber-yoddha/dashboard');
        }
        return view('frontend.yoddha.yoddha_login', [
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
        if (DB::table('yoddha_team')->where('email', $username)->orWhere('phone', $username)->where('is_active', 1)->exists()) {
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
            $res = DB::table('yoddha_team')->where('email', $username)->orWhere('phone', $username)->first();
            $phone = $res->phone;
            $email = $res->email;

            //update token
            DB::table('yoddha_team')->where('email', $email)->where('phone', $phone)->update(['token' => $token]);

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

            return view('frontend.yoddha.otp', [
                'email' => $email,
                'phone' => $phone,
                'token' => $token,
                'error' => ($otp_send) ? false : true,
                'error_message' => ($otp_send) ? '' : $error_message,
                'otp' => env('APP_DEBUG') ? $otp : '',
            ]);
        } else {
            return view('frontend.yoddha.otp', [
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
                Session::put('admin', $auth_user);
                return redirect('/cyber-yoddha/dashboard');
            }
        } else {
            return redirect('/login')->with('message', 'error|Unable to verify submitted OTP');
        }
    }

    //logout
    public function logout()
    {
        Session::flush();
        return redirect('/cyber-yoddha/login');
    }

    //cyber-yoddha/dashboard
    public function dashboard(Request $request)
    {

        return view(
            'frontend.yoddha.dashboard',
            [
                'module'        =>    'dashboard'
            ]
        );
    }

    public function submission(Request $r)
    {

        $file = $r->file('c_cv');
        $file_ext = strtolower($file->getClientOriginalExtension());
        $file_name = "";
        $file_name = $r->input('c_name') . date('YmdHis') . ".pdf";

        if (validMimeType($file)) {
            // file upload location
            $location = 'upload/yoddha_register';
            //create directory
            if (!is_dir($location)) {
                @mkdir($location, 0777);
                //exit()
            }
            // upload file
            $file->move($location, $file_name);
            $file_path = $location . "/" . $file_name;
            if ($r->input('cand_step') == 'Student') {
                $c_work = $r->input('c_last_status');
            } else {
                $c_work = $r->input('c_prf_status');
            }

            $data = [
                'c_prmt_adress' => $r->input('c_prmt_adress'),
                'c_name' => $r->input('c_name'),
                'c_phone_no' => $r->input('c_phone_no'),
                'c_email' => $r->input('c_email'),
                'c_dob' => date("Y-m-d", strtotime($r->input('c_dob'))),
                'cand_step' => $r->input('cand_step'),
                'c_last_status' => $c_work,
                'c_org' => $r->input('c_org'),
                'c_cntribut1' => $r->input('c_cntribut1'),
                'c_cntribut2' => $r->input('c_cntribut2'),
                'c_cntribut3' => $r->input('c_cntribut3'),
                'c_prf_crtf' => $r->input('c_prf_crtf'),
                'c_year_exp' => $r->input('c_year_exp'),
                'c_month_exp' => $r->input('c_month_exp'),
                'c_req_crtf' => $r->input('c_req_crtf'),
                'c_awrd_crtf' => $r->input('c_awrd_crtf'),
                'c_publc_crtf' => $r->input('c_publc_crtf'),
                'c_papr_crtf' => $r->input('c_papr_crtf'),
                'c_thng_crtf' => $r->input('c_thng_crtf'),
                'c_thougt_crtf' => $r->input('c_thougt_crtf'),
                'othr_inf' => $r->input('othr_inf'),
                'c_cv' => $file_path
            ];
            $created = DB::table('yoddha_registrations')->insert($data);
            if ($created) {
                return redirect('/cyber-yoddha/register')->with('message', 'success|Your Registration is Successful');
            } else {
                return redirect('/cyber-yoddha/register')->with('message', 'error|Something Went Wrong');
            }
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
        } else {
            return redirect('/cyber-yoddha/register')->with('message', 'error|File Type Not Supported,Try again');
        }
    }

    public function about_cyber_yoddha(Request $r)
    {
        return view('frontend.new_pages.about');
    }

    public function yoddha_login(Request $r)
    {
        return view('frontend.yoddha.yoddha_login');
    }

    public function yoddha_team(Request $request)
    {
        $role = Session::get('admin')['sess_role_name'];
        if ($role == 'spoc') {
            $yoddhas = DB::table('yoddha_team')->where('y_status', 'approved')->orderBy('id', 'DESC')->get();
        } else {
            $yoddhas = DB::table('yoddha_team')->where('y_status', 'approved')->where('role', $role)->where('id', Session::get('admin')['sess_admin_id'])->orderBy('id', 'DESC')->get();
        }

        return view(
            'frontend.yoddha.yoddhas_team',
            [
                'module'    =>  'yoddha-team',
                'yoddhas'   =>  $yoddhas
            ]
        );
    }

    public function contact_us(Request $request){
        return view('frontend.new_pages.contact');
    }
}
