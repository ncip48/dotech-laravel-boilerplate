<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'group_id' => 1,
                    'name' => 'Administrator',
                    'email' => 'admin@gmail.com',
                    'username' => 'admin',
                    'password' => bcrypt('admin'),
                    'is_active' => true,
                ],
                [
                    'group_id' => 2,
                    'name' => 'User',
                    'email' => 'user@gmail.com',
                    'username' => 'user',
                    'password' => bcrypt('user'),
                    'is_active' => true,
                ]
            ]
        );
    }
}
