<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderC2DMain extends Model
{
    protected $table = 'sales_order_c2d_main';
    protected $fillable = ['id','entry_date','order_date','market_creation_id','dealer_creation_id','address','order_no','status','description','sales_exec','closingTime1','arrivingTime','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
