<?php

namespace App\Enum;

enum RulesEnum: string
{
    case OBJ_COUNTRY = 'страна отеля';
    case OBJ_CITY = 'город отеля';
    case OBJ_STARDOM = 'звездность отеля';
    case OBJ_COMMISSION_DISCOUNT = 'в договоре комиссия или скидка';
    case OBJ_IS_DEFAULT = 'договор по умолчанию';
    case OBJ_COMPANY_WITH_HOTEL = 'компания в договоре с отелем';
    case OBJ_BLACKLIST = 'черный список';
    case OBJ_REC_HOTEL = 'рекомендованный отель';
    case OBJ_WHITELIST = 'белый список';

    public static function getConditionsList(): array
    {
        return [
            self::OBJ_COUNTRY->name => ConditionEnum::getConditions(self::OBJ_COUNTRY),
            self::OBJ_CITY->name => ConditionEnum::getConditions(self::OBJ_CITY),
            self::OBJ_STARDOM->name => ConditionEnum::getConditions(self::OBJ_STARDOM),
            self::OBJ_COMMISSION_DISCOUNT->name => ConditionEnum::getConditions(self::OBJ_COMMISSION_DISCOUNT),
            self::OBJ_IS_DEFAULT->name => ConditionEnum::getConditions(self::OBJ_IS_DEFAULT),
            self::OBJ_COMPANY_WITH_HOTEL->name => ConditionEnum::getConditions(self::OBJ_COMPANY_WITH_HOTEL),
            self::OBJ_BLACKLIST->name => ConditionEnum::getConditions(self::OBJ_BLACKLIST),
            self::OBJ_REC_HOTEL->name => ConditionEnum::getConditions(self::OBJ_REC_HOTEL),
            self::OBJ_WHITELIST->name => ConditionEnum::getConditions(self::OBJ_WHITELIST),
        ];
    }

    public static function getTypeInputList(): array
    {
        return [
            self::OBJ_COUNTRY->name => ConditionEnum::getInputOptions(self::OBJ_COUNTRY),
            self::OBJ_CITY->name => ConditionEnum::getInputOptions(self::OBJ_CITY),
            self::OBJ_STARDOM->name => ConditionEnum::getInputOptions(self::OBJ_STARDOM),
            self::OBJ_COMMISSION_DISCOUNT->name => ConditionEnum::getInputOptions(self::OBJ_COMMISSION_DISCOUNT),
            self::OBJ_IS_DEFAULT->name => ConditionEnum::getInputOptions(self::OBJ_IS_DEFAULT),
            self::OBJ_COMPANY_WITH_HOTEL->name => ConditionEnum::getInputOptions(self::OBJ_COMPANY_WITH_HOTEL),
            self::OBJ_BLACKLIST->name => ConditionEnum::getInputOptions(self::OBJ_BLACKLIST),
            self::OBJ_REC_HOTEL->name => ConditionEnum::getInputOptions(self::OBJ_REC_HOTEL),
            self::OBJ_WHITELIST->name => ConditionEnum::getInputOptions(self::OBJ_WHITELIST),
        ];
    }
}
