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
            'name' => 'Sihub el hubski da vinci',
            'email' => 'superadmin_sakkarepmu@admin.com',
            'password' => bcrypt('superadmin'),
            'gambar_profile' => 'gricon.png',
        ]);

        $superadmin->assignRole($superadminRole);

        $admin = User::create([
            'name' => 'Deru el pedro samudro',
            'email' => 'admin_sakkarepmu@admin.com',
            'password' => bcrypt('admin'),
            'gambar_profile' => 'gricon.png',
        ]);

        $admin->assignRole($adminRole);

        $user = User::create([
            'name' => 'Owi chan',
            'email' => 'user_sakkarepmu@user.com',
            'password' => bcrypt('user'),
            'gambar_profile' => 'gricon.png',
        ]);

        $user->assignRole($userRole);
    }
}