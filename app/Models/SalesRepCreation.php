<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRepCreation extends Model
{
    protected $table = 'sales_ref_creation';
    protected $fillable = ['id','sales_ref_name','mobile_no','phone_no','address','pin_gst_no','aadhar_no','driving_licence','state_id','district_id','area_id','image_name','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent','manager_id'];

    // id	entry_date	distributor_id	sales_ref_name	mobile_no	phone_no	address	pin_gst_no	state_id	district_id	area_id	image_name	delete_status	created_at	updated_at	created_user_id	updated_user_id	created_ipaddress	updated_ipaddress	created_user_agent	updated_user_agent
}
