<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTypeCreation extends Model
{
    protected $table = 'expense_type_creation';
    protected $fillable = ['id','expense_type','description','delete_status'];
}
