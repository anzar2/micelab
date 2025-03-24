<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        $this->call([
            TestTypeSeeder::class,
            TestStatusSeeder::class,
            UserRoleSeeder::class,
            ThemesSeeder::class,
            TimezoneSeeder::class,
            LanguagesSeeder::class,
            ExampleDataSeeder::class
        ]);
    }
}
