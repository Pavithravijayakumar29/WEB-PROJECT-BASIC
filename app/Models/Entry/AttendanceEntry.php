<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceEntry extends Model
{
    protected $table = 'attendance_entry';
    protected $fillable = ['id','entry_date','shift_type','state_id','shift_type1','district_id','area_id','manager_name','attendance_type','shift_type','category_type','description','check','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
