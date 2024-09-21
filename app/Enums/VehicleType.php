<?php

namespace App\Enums;

enum VehicleType
{
    const MOTOR = 1;
    const MOBIL = 2;
    const BUS = 3;

    public static function getValues(): array
    {
        return [
            'Motor' => self::MOTOR,
            'Mobil' => self::MOBIL,
            'Bus' => self::BUS,
        ];
    }
}
