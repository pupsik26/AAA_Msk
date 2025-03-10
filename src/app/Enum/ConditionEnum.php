<?php

namespace app\Enum;

enum ConditionEnum: string
{
    case EQUAL = 'равно';
    case NOT_EQUAL = 'не равно';
    case MORE = 'больше';
    case LESS = 'меньше';

    public static function getConditions($object): array
    {
        return match ($object) {
            RulesEnum::OBJ_COUNTRY,
            RulesEnum::OBJ_CITY,
            RulesEnum::OBJ_STARDOM,
            RulesEnum::OBJ_COMPANY_WITH_HOTEL => [
                self::EQUAL->name => self::EQUAL->value,
                self::NOT_EQUAL->name => self::NOT_EQUAL->value,
            ],

            RulesEnum::OBJ_COMMISSION_DISCOUNT => [
                self::EQUAL->name => self::EQUAL->value,
                self::NOT_EQUAL->name => self::NOT_EQUAL->value,
                self::MORE->name => self::MORE->value,
                self::LESS->name => self::LESS->value
            ],

            RulesEnum::OBJ_IS_DEFAULT,
            RulesEnum::OBJ_BLACKLIST,
            RulesEnum::OBJ_REC_HOTEL,
            RulesEnum::OBJ_WHITELIST => [
                self::EQUAL->name => self::EQUAL->value
            ],
            default => []
        };
    }

    public static function getInputOptions($object): array
    {
        return match ($object) {
            RulesEnum::OBJ_COUNTRY,
            RulesEnum::OBJ_BLACKLIST,
            RulesEnum::OBJ_COMPANY_WITH_HOTEL,
            RulesEnum::OBJ_COMMISSION_DISCOUNT,
            RulesEnum::OBJ_CITY => [],

            RulesEnum::OBJ_STARDOM => ['min' => 1, 'max' => 5],

            RulesEnum::OBJ_WHITELIST,
            RulesEnum::OBJ_IS_DEFAULT,
            RulesEnum::OBJ_REC_HOTEL => ['min' => 0, 'max' => 1],

            default => ['min' => 0, 'max' => 0]
        };
    }

    public static function getSymbol($str): string
    {
        return match ($str) {
            self::EQUAL->name => '=',
            self::NOT_EQUAL->name => '!=',
            self::MORE->name => '>',
            self::LESS->name => '<',
        };
    }
}
