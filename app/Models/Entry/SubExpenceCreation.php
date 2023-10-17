<?php

namespace App\Models\Entry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubExpenceCreation extends Model
{
    protected $table = 'expense_entry_sub';
    protected $fillable = ['id','expence_main_id','sub_expence','from_location','to_location','amount','delete_status','created_at','updated_at'];
}
