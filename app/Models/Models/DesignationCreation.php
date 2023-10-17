<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationCreation extends Model
{
    protected $table = 'designation_creation';
    protected $fillable = ['id','designation_name','description','delete_status']; 
}
