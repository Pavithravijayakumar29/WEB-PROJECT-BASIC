<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDeliveryMain extends Model
{
    protected $table = 'sales_order_delivery_main_c';
    protected $fillable = ['id','entry_date','order_date','dispatch_date','order_recipt_no','state_id','district_id','market_creation_id','sales_exec','dealer_creation_id','shop_creation_id','delivery_no','status','vehile_name','driver_name','driver_number','tally_no','description','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
