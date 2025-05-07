<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    // Define the table name (optional, Laravel will assume it's 'email_settings' if not provided)
    protected $table = 'email_settings';  // Change this if your table name is different
    
    // Specify the fields that are mass assignable
    protected $fillable = [
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_pass',
        'from_address',
        'from_name',
    ];

    // If you want to automatically manage timestamps (created_at, updated_at)
    public $timestamps = false;  // Set to false if your table doesn't use timestamps

    // Optionally, you can also define custom accessors and mutators
}
