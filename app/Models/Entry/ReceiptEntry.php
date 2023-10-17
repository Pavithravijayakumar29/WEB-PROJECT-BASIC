<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptEntry extends Model
{

    protected $table = 'receipt_entry';
    protected $fillable = ['id','tally_no','order_date','ledger_name','order_no','comment'];
}


