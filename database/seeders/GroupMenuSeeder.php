<?php

namespace Database\Seeders;

use App\Models\Setting\GroupMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //admin
        GroupMenu::insert([
            [
                'group_id' => 1,
                'menu_id' => 1,
                'create' => false,
                'read' => true,
                'update' => false,
                'delete' => false,
            ], [
                'group_id' => 1,
                'menu_id' => 3,
                'create' => false,
                'read' => true,
                'update' => false,
                'delete' => false,
            ], [
                'group_id' => 1,
                'menu_id' => 4,
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ], [
                'group_id' => 1,
                'menu_id' => 5,
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ],  [
                'group_id' => 1,
                'menu_id' => 6,
                'create' => false,
                'read' => true,
                'update' => false,
                'delete' => false,
            ], [
                'group_id' => 1,
                'menu_id' => 7,
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ], [
                'group_id' => 1,
                'menu_id' => 8,
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ],
        ]);

        //user
        GroupMenu::insert([
            [
                'group_id' => 2,
                'menu_id' => 1,
                'create' => false,
                'read' => true,
                'update' => false,
                'delete' => false,
            ],
            [
                'group_id' => 2,
                'menu_id' => 2,
                'create' => false,
                'read' => true,
                'update' => false,
                'delete' => false,
            ],
        ]);
    }
}
