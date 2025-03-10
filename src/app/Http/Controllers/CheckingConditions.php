<?php

namespace App\Http\Controllers;

use app\Enum\ConditionEnum;
use App\Enum\RulesEnum;
use App\Models\Conditions;
use App\Models\Rules;
use Illuminate\Support\Facades\DB;

class CheckingConditions extends Controller
{

    public function check($id)
    {
        $agencyIds = DB::table('agency_hotel_options')
            ->distinct()
            ->where('hotel_id', '=', $id)
            ->pluck('agency_id');

        $rules = Rules::whereIn('agency_id', $agencyIds->toArray())
            ->where('is_active', '=', Rules::IS_ACTIVE)
            ->get();


        $arrText = [];

        /** @var Rules $rule */
        foreach ($rules as $rule) {
            $conditions = $rule->conditions;
            $isCondition = true;

            /* @var Conditions $condition */
            foreach ($conditions as $condition) {
                if (!$this->isEmptyCondition($condition, $rule->agency_id)) {
                    $isCondition = false;
                    break;
                }
            }

            if ($isCondition) {
                $arrText[] = "{$rule->text} {$rule->agency->name}";
            }
        }

        return redirect()->route('index')
            ->with('success', $arrText);
    }

    private function isEmptyCondition(Conditions $condition, int $agencyId): bool
    {
        switch ($condition->name) {
            case RulesEnum::OBJ_COUNTRY->name:
                return DB::table('php_test.agency_hotel_options as ago')
                    ->leftJoin('hotels as h', 'h.id', '=', 'ago.hotel_id')
                    ->leftJoin('cities as c', 'c.id', '=', 'h.city_id')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('country_id', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_CITY->name:
                return DB::table('agency_hotel_options as ago')
                    ->leftJoin('hotels as h', 'h.id', '=', 'ago.hotel_id')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('city_id', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_STARDOM->name:
                return DB::table('agency_hotel_options as ago')
                    ->leftJoin('hotels as h', 'h.id', '=', 'ago.hotel_id')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('h.stars', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_COMMISSION_DISCOUNT->name:
                return DB::table('agency_hotel_options as ago')
                    ->leftJoin('hotel_agreements as ha', 'ha.hotel_id', '=', 'ago.hotel_id')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where(function ($query) use ($condition) {
                        $query->where('discount_percent', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                            ->orWhere('comission_percent', ConditionEnum::getSymbol($condition->condition), $condition->equality);
                    })->exists();
            case RulesEnum::OBJ_IS_DEFAULT->name:
                return DB::table('agency_hotel_options as ago')
                    ->leftJoin('hotel_agreements as ha', 'ha.hotel_id', '=', 'ago.hotel_id')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('ha.is_default', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_COMPANY_WITH_HOTEL->name:
                return DB::table('agency_hotel_options as ago')
                    ->leftJoin('hotel_agreements as ha', 'ha.hotel_id', '=', 'ago.hotel_id')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('ha.company_id', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_BLACKLIST->name:
                return DB::table('agency_hotel_options as ago')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('is_black', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_REC_HOTEL->name:
                return DB::table('agency_hotel_options as ago')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('is_recomend', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            case RulesEnum::OBJ_WHITELIST->name:
                return DB::table('agency_hotel_options as ago')
                    ->where('ago.agency_id', '=', $agencyId)
                    ->where('is_white', ConditionEnum::getSymbol($condition->condition), $condition->equality)
                    ->exists();
            default:
                return false;
        }
    }

}
