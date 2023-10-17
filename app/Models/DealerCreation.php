<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerCreation extends Model
{
    protected $table = 'dealer_creation';
    protected $fillable = ['id','entry_date','manager_name','sales_rep_id','dealer_name','mobile_no','whatsapp_no','address','pan_no','gst_no','aadhar_no','driving_licence','bank_name','check_no','state_id','district_id','area_id','status','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
