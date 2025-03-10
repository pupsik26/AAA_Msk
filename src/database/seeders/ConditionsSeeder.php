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
            'name' => RulesEnum::OBJ_STARDOM->name,
            'condition' => ConditionEnum::EQUAL->name,
            'equality' => 3
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_STARDOM->name,
            'condition' => ConditionEnum::EQUAL->name,
            'equality' => 5
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_STARDOM->name,
            'condition' => ConditionEnum::EQUAL->name,
            'equality' => 1
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_CITY->name,
            'condition' => ConditionEnum::EQUAL->name,
            'equality' => 2
        ]);

        DB::table('conditions')->insert([
            'name' => RulesEnum::OBJ_COMMISSION_DISCOUNT->name,
            'condition' => ConditionEnum::MORE->name,
            'equality' => 5
        ]);
    }
}
