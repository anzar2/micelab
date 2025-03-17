<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('user_roles')->insert([
            [
                'role' => 'admin',
                'can_create_project' => true,
                'can_delete_project' => true,
                'can_manage_users' => true,
            ],
            [
                'role' => 'developer',
                'can_create_project' => true,
                'can_delete_project' => true,
                'can_manage_users' => false,
            ]
        ]);
    }
}
