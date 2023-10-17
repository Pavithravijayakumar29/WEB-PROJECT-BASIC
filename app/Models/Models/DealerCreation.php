<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerCreation extends Model
{
    protected $table = 'dealer_creation';
    protected $fillable = ['id','entry_date','dealer_name','mobile_no','phone_no','address','pin_gst_no','latitude','longitude','state_id','district_id','area_id','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
