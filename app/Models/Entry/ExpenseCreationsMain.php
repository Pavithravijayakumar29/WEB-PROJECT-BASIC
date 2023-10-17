<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCreationsMain extends Model
{
    protected $table = 'expense_creations_main';
    protected $fillable = ['id','entry_date','expense_date','sales_rep_creation_id','dealer_creation_id','expense_no','status','sales_exec','arrivingTime','closingTime1','description','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent','mode_of_payment','market_manager_id'];
}
