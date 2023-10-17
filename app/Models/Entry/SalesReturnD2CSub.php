<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnD2CSub extends Model
{
    protected $table = 'sales_return_d2c_sublist';
    protected $fillable = ['id','entry_date','sales_order_main_id','order_date_sub','time_sub','tally_no','batch_no','return_type_id','item_creation_id','current_stock','order_quantity','pieces_quantity','item_property','item_weights','item_price','total_amount','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
