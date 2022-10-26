<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // membuat seeder User
        $superAdmin = User::create([
            "name"      => "admin",
            "email"     => "admin@test",
            "password"  => Hash::make("admin123"),
        ]);

        $superAdmin->attachRole('superadmin');

        $dev = User::create([
            "name"      => "dev",
            "email"     => "dev@test.com",
            "password"  => Hash::make("dev@test.com"),
        ]);

        $dev->attachRole('dev');
    }
}
