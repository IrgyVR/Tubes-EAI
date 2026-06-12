<?php

namespace Database\Seeders;

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
        // Tell Laravel to run our specific Gundam seeder
        $this->call([
            KitSeeder::class,
        ]);
    }
}