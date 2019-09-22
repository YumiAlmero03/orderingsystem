<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
        	'name' => 'rice'
        ]);
        DB::table('categories')->insert([
        	'name' => 'dessert'
        ]);
        DB::table('categories')->insert([
        	'name' => 'burger'
        ]);
    }
}
