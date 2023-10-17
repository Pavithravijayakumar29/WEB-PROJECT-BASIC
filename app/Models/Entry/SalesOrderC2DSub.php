<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderC2DSub extends Model
{
    protected $table = 'sales_order_c2d_sublist';
    protected $fillable = ['id','entry_date','sales_order_main_id','order_date_sub','time_sub','market_creation_id','item_creation_id','current_stock','order_quantity','balance_quantity','item_property','item_weights','item_price','total_amount','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
