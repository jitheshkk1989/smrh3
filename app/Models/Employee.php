<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Company;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Relations\HasOne;  // Import the correct HasOne
use Illuminate\Database\Eloquent\Relations\HasMany; 
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'company_id', 'user_group_id', 'employee_code', 'designation', 'department',
        'date_of_joining', 'contact_number', 'alternate_contact', 'address', 'city', 'state',
        'country', 'pincode'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id');
    }

    public function professionalDetail(): HasMany  // OR professionalDetails() - BE CONSISTENT
    {
        return $this->hasMany(ProfessionalDetail::class, 'employee_id');
    }

    public function contactDetail(): \Illuminate\Database\Eloquent\Relations\HasOne    // Fully qualified
    {
        return $this->hasOne(ContactDetail::class, 'employee_id');
    }

    public function financeDetail(): \Illuminate\Database\Eloquent\Relations\HasOne    // Fully qualified
    {
        return $this->hasOne(FinanceDetail::class, 'employee_id');
    }
}