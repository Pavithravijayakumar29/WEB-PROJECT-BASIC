<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketManagerCreation extends Model
{
    protected $table = 'market_manager_creation';
    protected $fillable = ['id','manager_no','manager_name','gender','address','contact_no','whatsapp_no','email_address','image_name','status1','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
