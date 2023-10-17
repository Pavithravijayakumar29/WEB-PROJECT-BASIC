<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderStockSub extends Model
{
    protected $table = 'sales_order_stock_sublist';
    protected $fillable = ['id','entry_date','sales_order_main_id','item_creation_id','item_property','short_code_id','item_weights','opening_stock','current_stock','pieces_quantity','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
