<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    protected $table = 'account_ledgers';
    protected $fillable = ['id','ledger_name','description'];
}
