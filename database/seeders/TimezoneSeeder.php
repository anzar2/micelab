<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timezones = [];
        foreach (\DateTimeZone::listIdentifiers() as $key => $timezone) {
            $timezones[] = ['code' => (int)$key,'name'=> str_replace("_"," ", $timezone)];
        }
        \DB::table("timezones")->insert($timezones);
    }
}
