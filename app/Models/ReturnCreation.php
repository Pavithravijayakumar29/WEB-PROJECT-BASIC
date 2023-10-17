<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCreation extends Model
{
    protected $table = 'return_type_creation';
    protected $fillable = ['id','return_type','description','delete_status'];
}
