<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCreation extends Model
{
    protected $table = 'group_creation';
    protected $fillable = ['id','category_id','group_name','hsn_code','description','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}
 

