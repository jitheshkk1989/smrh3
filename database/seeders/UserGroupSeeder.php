<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Insert Administrator group
        DB::table('user_groups')->insert([
            'group_name' => 'Administrator',
            'description' => 'Full access to all features in the system.',
        ]);

        // Insert Employee group
        DB::table('user_groups')->insert([
            'group_name' => 'Employee',
            'description' => 'Regular employee with limited access.',
        ]);
    }
}
