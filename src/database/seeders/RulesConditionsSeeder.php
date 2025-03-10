<?php

namespace Database\Seeders;

use App\Models\Conditions;
use App\Models\Rules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RulesConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditionsIds = Conditions::all('id')->pluck('id')->toArray();
        $rules = Rules::all();
        foreach ($rules as $rule) {
            $arrKey = array_rand($conditionsIds, rand(2, count($conditionsIds)));
            foreach ($arrKey as $key) {
                $rule->conditions()->attach($conditionsIds[$key]);
            }
        }
    }
}
