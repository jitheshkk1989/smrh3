<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'general'],
            ['value' => [
                'company_name' => 'Demo Company',
                'company_logo' => null,
                'address' => '123 Demo Street, Sample City',
                'time_zone' => 'Asia/Kolkata',
                'currency' => 'INR',
                'fiscal_year' => '2025-04-01',
                'date_format' => 'Y-m-d',
                'working_days' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                'holidays' => '2025-01-01,2025-08-15',
            ]]
        );
    }
}
