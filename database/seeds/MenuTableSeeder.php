<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('master_menus')->insert([
            'id' => 1,
            'name' => 'Admin',
        ]);

        DB::table('menus')->insert([
            'parent_id' => 0,
            'master_menu_id' => 1,
            'text' => 'Website',
            'route' => 'admin.student.index',
            'icon' => 'mdi mdi-web',
            'sort' => 1
        ]);
        DB::table('menus')->insert([
            'parent_id' => 0,
            'master_menu_id' => 1,
            'text' => 'Student',
            'route' => 'admin.student.index',
            'icon' => 'mdi mdi-account-multiple-outline',
            'sort' => 1
        ]);
        DB::table('menus')->insert([
            'parent_id' => 2,
            'master_menu_id' => 1,
            'text' => 'Student Attendance',
            'route' => 'admin.student.index',
            'icon' => '',
            'sort' => 1
        ]);
        DB::table('menus')->insert([
            'parent_id' => 2,
            'master_menu_id' => 1,
            'text' => 'Manage Student',
            'route' => 'admin.student.index',
            'icon' => '',
            'sort' => 2
        ]);
        DB::table('menus')->insert([
            'parent_id' => 0,
            'master_menu_id' => 1,
            'text' => 'Menu Builder',
            'route' => 'admin.menu-builder.index',
            'icon' => 'mdi mdi-menu',
            'sort' => 2
        ]);
    }
}
