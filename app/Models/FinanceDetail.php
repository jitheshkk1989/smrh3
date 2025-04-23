<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'salary',
        'bank_name',
        'account_number',
        'pan_number',
    ];
}
