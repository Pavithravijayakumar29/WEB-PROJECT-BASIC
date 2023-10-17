<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictCreation extends Model
{
    

    protected $table = 'district_creation';
    protected $fillable = ['id','country_id','state_id','district_name','description','delete_status','created_at'];
}
