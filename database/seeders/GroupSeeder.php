<?php

namespace Database\Seeders;

use App\Models\Setting\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::insert(
            [
                [
                    'code' => 'ADMIN',
                    'name' => 'Administrator',
                    'is_active' => true,
                ],
                [
                    'code' => 'USER',
                    'name' => 'User',
                    'is_active' => true,
                ]
            ]
        );
    }
}
