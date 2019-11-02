<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /** * Run the database seeds. * * @return void */
    public function run()
    {
        DB::table('menus')->insert([
        	'name' => 'Menu 1',
        	'desc' => 'description menu',
        	'price' => 300.00,
        	'feat' => 1,
        	'category_id' => 2,
        	'active' => 1
        ]);
        DB::table('menus')->insert([
        	'name' => 'Menu 2',
        	'desc' => 'description menu',
        	'price' => 300.00,
        	'feat' => 1,
        	'category_id' => 3,
        	'active' => 1
        ]);
        DB::table('menus')->insert([
            'name' => 'Chicken Soup',
            'desc' => 'description menu',
            'price' => 300.00,
            'feat' => 1,
            'category_id' => 3,
            'active' => 1
        ]);
    }
}
