<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderStockMain extends Model
{
    protected $table = 'sales_order_stock_main';
    protected $fillable = ['id','entry_date','stock_entry_date','dealer_creation_id','dealer_address','order_no','status','description','sales_exec','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
