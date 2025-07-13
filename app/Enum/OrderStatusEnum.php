<?php

namespace App\Enum;

class OrderStatusEnum
{

    const PENDING = 'pending';
    const WAITING = 'waiting';
    const PREPARING = 'preparing';
    const FINISHING = 'finishing';
    const DELIVERING = 'delivering';
    const CHECKOUT = 'checkout';
    const PRINT = 'print';
    const DONE = 'done';


    public static function InternalOrderStatus()
    {
        return [
            self::PENDING,
            self::WAITING,
            self::PREPARING,
            self::FINISHING,
            self::DELIVERING,
        ];
    }

    public static function InvoiceStatus()
    {
        return [
            self::CHECKOUT,
            self::PRINT,
            self::DONE,
        ];
    }

}
