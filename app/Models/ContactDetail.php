<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id', // Assuming this is needed (foreign key)
        'permanent_address',
        'current_address',
        'phone_emergency',
    ];
}
