<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('test_status')->insert([
            ['status' => 'pending'],
            ['status' => 'passed'],
            ['status' => 'failed'],
            ['status' => 'skipped'],
        ]);
    }
}
