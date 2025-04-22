<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'short_name', 'registration_number', 'email', 'phone', 'alternate_phone',
        'website', 'address', 'city', 'state', 'country', 'pincode', 'is_active', 'parent_id'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function parent()
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function branches()
    {
        return $this->hasMany(Company::class, 'parent_id');
    }
}
