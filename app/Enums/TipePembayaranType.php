<?php

namespace App\Enums;

enum TipePembayaranType: string
{
    case LUNAS = 'lunas';
    case DP = 'dp';
    case DENDA = 'denda';

    public static function getAll(): array
    {
        return [
            self::LUNAS->value,
            self::DP->value,
            self::DENDA->value,
        ];
    }
}
