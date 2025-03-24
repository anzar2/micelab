<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Owners are like "superusers". Is the admin of the platform. 
     * Can manage teams, projects, and users.
     * 
     * Admins can manage projects and users, but cannot create teams. 
     * Think of this way: an admin is a "superuser" of a team. But not of the platform.
     * 
     * Developers can only create tasks, and only view projects and tasks that they are assigned to.
     * 
     * Note: All users can be owners, admins, or developers. It's up on the owners who decides it.
     */
    public function run(): void
    {
        UserRole::insert([
            ['name' => 'developer'],
            ['name' => 'admin'],
            ['name' => 'owner']
        ]);
    }
}
