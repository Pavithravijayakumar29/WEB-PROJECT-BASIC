<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderD2Ssub extends Model
{
    protected $table = 'sales_order_d2s_sublist';
    protected $fillable = ['id','entry_date','sales_order_main_id','status_check','order_date_sub','arriving_time_sub','closing_time_sub','shop_creation_id','item_creation_id','short_code_id','current_stock','order_quantity','item_property','item_weights','item_price','total_amount','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
