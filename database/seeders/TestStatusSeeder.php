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
            ['status' => 'pending'],
            ['status' => 'passed'],
            ['status' => 'failed'],
            ['status' => 'skipped'],
        ]);
    }
}
