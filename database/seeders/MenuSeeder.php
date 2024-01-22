<?php

namespace Database\Seeders;

use App\Models\Setting\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            [
                'code' => 'DASHBOARD',
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'level' => 1,
                'order' => 1,
                'parent_id' => NULL,
                'tag' => 'dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'is_active' => true,
            ],
            [
                'code' => 'MASTER',
                'name' => 'Master',
                'url' => NULL,
                'level' => 1,
                'order' => 2,
                'parent_id' => NULL,
                'tag' => 'master',
                'icon' => 'fas fa-list',
                'is_active' => true,
            ],
            [
                'code' => 'MASTER.USER',
                'name' => 'User',
                'url' => 'master/user',
                'level' => 2,
                'order' => 1,
                'parent_id' => 2,
                'tag' => 'master-user',
                'icon' => 'far fa-circle',
                'is_active' => true,
            ],
            [
                'code' => 'SETTING',
                'name' => 'Setting',
                'url' => NULL,
                'level' => 1,
                'order' => 3,
                'parent_id' => NULL,
                'tag' => 'setting',
                'icon' => 'fas fa-cog',
                'is_active' => true,
            ],
            [
                'code' => 'SETTING.GROUP',
                'name' => 'Group',
                'url' => 'setting/group',
                'level' => 2,
                'order' => 1,
                'parent_id' => 4,
                'tag' => 'setting-group',
                'icon' => 'far fa-circle',
                'is_active' => true,
            ],
            [
                'code' => 'SETTING.MENU',
                'name' => 'Menu',
                'url' => 'setting/menu',
                'level' => 2,
                'order' => 2,
                'parent_id' => 4,
                'tag' => 'setting-menu',
                'icon' => 'far fa-circle',
                'is_active' => true,
            ]
        ]);
    }
}
