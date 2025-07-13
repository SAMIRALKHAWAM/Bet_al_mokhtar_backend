<?php

namespace App\Enum;

class OrderTypeEnum
{

    const INT = 'int';
    const EXT = 'ext';

    public static function toArray()
    {
        return [
            self::INT,
            self::EXT,
        ];
    }

}
