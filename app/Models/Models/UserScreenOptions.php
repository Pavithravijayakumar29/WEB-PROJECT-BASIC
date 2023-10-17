<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScreenOptions extends Model
{
    protected $table = 'user_screen_options';
    protected $fillable = ['id','option_name','make_default','delete_status'];
}
