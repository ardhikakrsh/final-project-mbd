<?php

namespace App\Enums;

enum RolesType: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case OWNER = 'owner';

    public static function getValues(): array
    {
        return [
            self::ADMIN->value,
            self::USER->value,
            self::OWNER->value,
        ];
    }
}
