<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $superadminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create users and assign roles
        $superadmin = User::create([
            'name' => 'Admin',
            'email' => 'superadmin_sakkarepmu@admin.com',
            'password' => bcrypt('superadmin'),
        ]);

        $superadmin->assignRole($superadminRole);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin_sakkarepmu@user.com',
            'password' => bcrypt('admin'),
        ]);

        $admin->assignRole($adminRole);

        $user = User::create([
            'name' => 'User',
            'email' => 'user_sakkarepmu@user.com',
            'password' => bcrypt('user'),
        ]);

        $user->assignRole($userRole);
    }
}