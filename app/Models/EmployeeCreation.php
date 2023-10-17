<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCreation extends Model
{
    protected $table = 'employee_creation';
    protected $fillable = ['id','employee_no','employee_name','gender','address','contact_no','phone_no','email_address','aadhar_no','designation_id','staff_head_id','dealer_id','salary','incentive','employee_photo','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
