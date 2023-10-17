<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCreation extends Model
{
    protected $table = 'customer_creation';
    protected $fillable = ['id','entry_date','customer_no','customer_name','perm_address','pin_gst_no','contact_no','phone_no','email_address','image_name','state_id','district_id','area_id','status1','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
