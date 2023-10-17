<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubExpenseTypeCreation extends Model
{
    protected $table = 'sub_expense_type_creation';
    protected $fillable = ['id','expense_type','sub_expense_type','description','delete_status'];
}
