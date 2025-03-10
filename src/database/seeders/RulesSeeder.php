<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rules')->insert([
            'name' => '1 правило',
            'agency_id' => 1,
            'text' => 'Текст для менеджера 1',
            'is_active' => 1
        ]);

        DB::table('rules')->insert([
            'name' => '2 правило',
            'agency_id' => 2,
            'text' => 'Текст для менеджера 2',
            'is_active' => 1
        ]);

        DB::table('rules')->insert([
            'name' => 'неактивное правило',
            'agency_id' => 1,
            'text' => 'Текст для неактивное правила 1',
            'is_active' => 0
        ]);
    }
}
