<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCreation extends Model
{
    protected $table = 'user_creation';
    protected $fillable = ['id','entry_date','user_type_id','staff_id','market_manager','designation_id','token_id','user_name','password','confirm_password','status','sess_user_type_id','sess_staff_id','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
