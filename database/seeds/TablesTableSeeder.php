<?php

use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tables')->insert([
            'place' => 'left',
        	'status' => 'done'
        ]);
        DB::table('tables')->insert([
            'status' => 'done',
        	'place' => 'corner'
        ]);
    }
}
