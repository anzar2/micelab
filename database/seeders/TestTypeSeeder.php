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
                'test_type' => 'unit-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'integration-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'functional-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'acceptance-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'end-to-end-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'smoke-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'regression-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'performance-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'load-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'stress-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'usability-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'security-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'compatibility-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'exploratory-test',
                'is_custom' => false,
            ],
            [
                'test_type' => 'a/b-test',
                'is_custom' => false,
            ],
        ]);
    }
}
