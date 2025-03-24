<?php

namespace Database\Seeders;

use App\Models\TestType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestType::insert([
            [
                'name' => 'unit-test',
                'is_custom' => false,
            ],
            [
                'name' => 'integration-test',
                'is_custom' => false,
            ],
            [
                'name' => 'functional-test',
                'is_custom' => false,
            ],
            [
                'name' => 'acceptance-test',
                'is_custom' => false,
            ],
            [
                'name' => 'end-to-end-test',
                'is_custom' => false,
            ],
            [
                'name' => 'smoke-test',
                'is_custom' => false,
            ],
            [
                'name' => 'regression-test',
                'is_custom' => false,
            ],
            [
                'name' => 'performance-test',
                'is_custom' => false,
            ],
            [
                'name' => 'load-test',
                'is_custom' => false,
            ],
            [
                'name' => 'stress-test',
                'is_custom' => false,
            ],
            [
                'name' => 'usability-test',
                'is_custom' => false,
            ],
            [
                'name' => 'security-test',
                'is_custom' => false,
            ],
            [
                'name' => 'compatibility-test',
                'is_custom' => false,
            ],
            [
                'name' => 'exploratory-test',
                'is_custom' => false,
            ],
            [
                'name' => 'a/b-test',
                'is_custom' => false,
            ],
        ]);
    }
}
