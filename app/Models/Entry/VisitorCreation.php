<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCreation extends Model
{
    protected $table = 'visitors_shops';
    protected $fillable = ['id','d2s_id','order_date','order_no','visitor_name','sales_exec','mobile_no','description','address','image_name','created_at','updated_at'];
}
			