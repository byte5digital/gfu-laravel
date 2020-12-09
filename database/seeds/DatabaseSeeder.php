<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // run BlogEntrySeeder
        $this->call(BlogEntrySeeder::class);

        // run CategorySeeder
        $this->call(CategorySeeder::class);

        // run UserSeeder
        $this->call(UserSeeder::class);
    }
}
