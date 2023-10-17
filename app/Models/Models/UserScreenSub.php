<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScreenSub extends Model
{
    protected $table = 'user_screen_sub';
    protected $fillable = ['id','entry_date','user_screen_main_id','sub_screen_name','description','status','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
