<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCreation extends Model
{
    protected $table = 'shop_creation';
    protected $fillable = ['id','entry_date','shop_name','shop_type_id','dealer_id','beats_id','mobile_no','whatsapp_no','address','gst_no','language','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
