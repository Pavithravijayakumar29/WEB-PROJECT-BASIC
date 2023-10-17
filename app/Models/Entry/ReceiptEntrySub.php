<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptEntrySub extends Model
{
    protected $table = 'receipt_entry_sub';
    protected $fillable = ['id','ledger_cr','amount','description1'];
}
