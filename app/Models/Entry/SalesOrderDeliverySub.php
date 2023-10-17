<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDeliverySub extends Model
{
    protected $table = 'sales_order_delivery_sublist_c';
    protected $fillable = ['id','entry_date','sales_order_main_id','checkbox','order_date_sub','time_sub','market_creation_id','shop_creation_id','order_recipt_sub_id','item_creation_id','opening_stock','current_stock','order_quantity','balance_quantity','return_quantity','item_property','item_weights','item_price','total_amount','paid_amount','bal_amount','dispatch_status','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
