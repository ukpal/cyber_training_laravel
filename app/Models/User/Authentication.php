<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Authentication extends Model
{

    //authenticate
    public function authenticate($token)
    {
        $a_tbl          =    'users';

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
            $user = array();
            if(count($res) == 2){
                for ($i=0; $i < count($res); $i++) { 
                    $data =   array(
                        'sess_admin_id'                  =>  $res[$i]->id,
                        'sess_admin_fullname'            =>  $res[$i]->fullname,
                        'sess_admin_phone'               =>  $res[$i]->phone,
                        'sess_admin_token'               =>  $res[$i]->token,
                        'sess_admin_email'               =>  $res[$i]->email,
                        'sess_role_name'                 =>  $res[$i]->role,
                        'sess_profile_photo'             =>  $res[$i]->profile_photo,
                        'sess_user_status'               =>  $user_status[$i],
                        'sess_user_permission'           =>  $permission                        
                    );
                    array_push($user, $data);
                }                
            }else{
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
            }
            return $user;
        } else {
            return null;
        }
    }

    public function authenticate_one($id)
    {
        $a_tbl          =    'users';

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
            ->where('id', $id);

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
