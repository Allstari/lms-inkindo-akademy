<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'name' => 'Inkindo Akademy',
            'alias' => 'Inkindo',
            'logo' => 'logo.png',
            'description' => 'lorem ipsum dolor sit amet',
            'phone' => '0823232323',
            'address' => 'Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
