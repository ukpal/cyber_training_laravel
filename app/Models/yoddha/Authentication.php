<?php

namespace App\Models\yoddha;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Authentication extends Model
{

    //authenticate
    public function authenticate($token)
    {
        $a_tbl          =    'yoddha_team';

        $query = DB::table($a_tbl)->select(
            'id',
            'fullname',
            'token',
            'email',
            'phone',
            'role',
            'profile_photo',
            'last_login',
            'is_active'
        )
            ->where('token', $token);

        $res = $query->get();

        $permission = array();

        if (count($res) > 0) {
            $user_status = 'PENDING';
            if ($res[0]->is_active == 1) {
                $user_status = 'APPROVED';
            } else if ($res[0]->is_active == 0) {
                $user_status = 'PENDING';
            }
            
            $user   =   array(
                'sess_admin_id'                  =>  $res[0]->id,
                'sess_admin_fullname'            =>  $res[0]->fullname,
                'sess_admin_phone'               =>  $res[0]->phone,
                'sess_admin_token'               =>  $res[0]->token,
                'sess_admin_email'               =>  $res[0]->email,
                'sess_role_name'                 =>  $res[0]->role,
                'sess_profile_photo'             =>  $res[0]->profile_photo,
                'sess_user_status'               =>  $user_status,
                'sess_user_permission'           =>  $permission
            );
            return $user;
        } else {
            return null;
        }
    }
}
