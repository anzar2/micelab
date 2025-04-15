<?php

namespace Database\Seeders;

use App\Models\TestStatus;
use Illuminate\Database\Seeder;

class TestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestStatus::insert([
            ['test_status' => 'pending'],
            ['test_status' => 'passed'],
            ['test_status' => 'failed'],
            ['test_status' => 'skipped'],
        ]);
    }
}
