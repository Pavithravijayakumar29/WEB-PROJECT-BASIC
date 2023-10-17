<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptEntryTallySublist extends Model
{

    protected $table = 'receipt_entry_tally_sublist';
    protected $fillable = ['id','receipt_entry_main_id','order_date_sub','item_creation_id','entry_date','total_amount','paid_amount','total_amount_1','bal_amount','pay_amount','check_amount','delete_status','created_at','updated_at','created_user_id','updated_user_id','created_ipaddress','updated_ipaddress','created_user_agent','updated_user_agent'];
}


