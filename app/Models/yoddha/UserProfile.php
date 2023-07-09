<?php

namespace App\Models\yoddha;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class UserProfile extends Model
{
    protected $table        =   'yoddha_team';
    public $timestamps      =   false;

    protected $fillable = [
        'fullname', 'phone', 'token', 'email', 'designation', 'organisation', 
        'role', 'profile_photo',  'last_login'
    ];
}
