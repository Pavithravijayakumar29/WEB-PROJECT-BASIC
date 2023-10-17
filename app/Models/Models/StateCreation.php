<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateCreation extends Model
{
    protected $table = 'state_creation';
    protected $fillable = ['id','country_id','state_name','description'];
}
