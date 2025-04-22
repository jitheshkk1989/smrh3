<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class SmrhCompanySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@smrh.com',
            'password' => Hash::make('password123'), // Secure password
        ]);
        // 1. Create the Company
        $company = Company::create([
            'name' => 'SMRH Company',
            'short_name' => 'SMRH',
            'registration_number' => 'SMRH-REG-001',
            'email' => 'info@smrh.com',
            'phone' => '1234567890',
            'website' => 'https://www.smrh.com',
            'address' => 'Corporate Ave, TechCity',
            'city' => 'TechCity',
            'state' => 'TechState',
            'country' => 'TechLand',
            'pincode' => '560001',
            'is_active' => true,
        ]);

        // 2. Create the User
       

        // 3. Get or Create Administrator Group
        $adminGroup = UserGroup::firstOrCreate(
            ['group_name' => 'Administrator'],
            ['description' => 'Full access to all features in the system.']
        );

        // 4. Create the Employee
        Employee::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'user_group_id' => $adminGroup->id,
            'employee_code' => 'EMP-SMRH-001',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@smrh.com',
            'phone' => '9876543210',
            'position' => 'HR Manager',
            'address' => '123 Admin Lane',
            'city' => 'TechCity',
            'state' => 'TechState',
            'country' => 'TechLand',
            'pincode' => '560001',
            'hire_date' => now(),
            'status' => 'active',
        ]);
    }
}
