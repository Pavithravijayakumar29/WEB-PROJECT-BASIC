<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceCreation extends Model
{
    protected $table = 'advance_entry';
    protected $fillable = ['id','entry_date','advance_no','staff_id','amount','cash_type','description','account_year','delete_status','created at','pending_advance','pen_adv_status'];
}
