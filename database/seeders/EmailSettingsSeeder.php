<?php

namespace Database\Seeders; // Add this namespace

use Illuminate\Database\Seeder;
use App\Models\EmailSetting;

class EmailSettingsSeeder extends Seeder
{
    public function run()
    {
        EmailSetting::create([
            'smtp_host' => 'smtp.example.com',
            'smtp_port' => '587',
            'smtp_user' => 'user@example.com',
            'smtp_pass' => 'secret',
            'from_address' => 'no-reply@example.com',
            'from_name' => 'My App',
        ]);
    }
}
