<?php

namespace Database\Seeders;

use app\Enum\ConditionEnum;
use App\Enum\RulesEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_STARDOM,
            'condition' => ConditionEnum::EQUAL,
            'equality' => 3
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_STARDOM,
            'condition' => ConditionEnum::EQUAL,
            'equality' => 5
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_STARDOM,
            'condition' => ConditionEnum::EQUAL,
            'equality' => 1
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_CITY,
            'condition' => ConditionEnum::EQUAL,
            'equality' => 2
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_COMMISSION_DISCOUNT,
            'condition' => ConditionEnum::MORE,
            'equality' => 5
        ]);
    }
}
