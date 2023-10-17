<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCreation extends Model
{
    protected $table = 'company_creation';
    protected $fillable = ['id','entry_date','company_name','address','mobile_no','phone_no','gst_no','tin_no','email_id','status1','image_name','sess_user_type_id','sess_user_id','sess_ipaddress','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
