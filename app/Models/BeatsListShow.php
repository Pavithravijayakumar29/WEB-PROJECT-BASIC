<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeatsListShow extends Model
{
    protected $table = 'beats_list_show';
    protected $fillable = ['id','dealer_id','area_id','language','created_at','updated_at'];
}
