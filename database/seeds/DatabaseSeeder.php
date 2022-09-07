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
        $this->call(CategoriesTableSeeder::class);
        $this->call(PerksTableSeeder::class);
        $this->call(SponsorisationsTableSeeder::class);
        // $this->call(MessagesTableSeeder::class );

    }
}
