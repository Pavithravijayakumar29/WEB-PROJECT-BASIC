<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCreation extends Model
{
    protected $table = 'item_creation';
    protected $fillable = ['id','category_id','group_id','item_name','item_code','hsn_code','tax_id','distributor_rate','sub_dealer_rate','piece','description','short_code','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}

