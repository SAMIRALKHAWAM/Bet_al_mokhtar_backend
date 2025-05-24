<?php

namespace App\Enum;

class EmployeeTypeEnum
{

    const CASHIER = 'cashier';
    const ACCOUNTANT = 'accountant';
    const WAITER = 'waiter';
    const CAPTAIN = 'captain';
    const WAREHOUSEMAN = 'warehouseman';
    const DELIVERYMAN = 'deliveryman';


    public static function toArray(){
        return [
            self::CASHIER,
            self::ACCOUNTANT,
            self::WAITER,
            self::CAPTAIN,
            self::WAREHOUSEMAN,
            self::DELIVERYMAN,
        ];

    }


}
