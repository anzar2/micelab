<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            "code" => "en",
            "name"=> "English",
        ]);
        
        Language::create([
            "code" => "es",
            "name" => "Español",
        ]);

        // ........
    }
}
