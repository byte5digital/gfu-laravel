<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // inserts Category with name PHP into categories table
        DB::table('categories')->insert([
            'name' => 'PHP'
        ]);
    }
}
