<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalDetail extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'department', 'designation', 'joining_date', 'experience'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}