<?php

use Illuminate\Database\Seeder;

class BlogEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generates 15 Blog entries using BlogEntryFactory
        factory(App\BlogEntry::class, 15)->create();
    }
}
