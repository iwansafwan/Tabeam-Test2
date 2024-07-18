<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $treasurerRole = Role::create(['name' => 'Treasurer']);
        $donatorRole = Role::create(['name' => 'Donator']);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
        ]);
        $admin->roles()->attach($adminRole);

        // Create treasurer user
        $treasurer = User::create([
            'name' => 'Treasurer User',
            'email' => 'treasurer@example.com',
            'password' => Hash::make('123'),
        ]);
        $treasurer->roles()->attach($treasurerRole);

        // Create donator user
        $donator = User::create([
            'name' => 'Donator User',
            'email' => 'donator@example.com',
            'password' => Hash::make('123'),
        ]);
        $donator->roles()->attach($donatorRole);
    }
}
