<?php

namespace App\Enums;
enum StatusSewaType: String
{
    case DITOLAK = 'ditolak';
    case DITERIMA = 'diterima';
    case SELESAI = 'selesai';
    case MENUNGGU = 'menunggu';

    public static function getStatuses(): array
    {
        return [
            self:: DITOLAK->value,
            self:: DITERIMA->value,
            self:: SELESAI->value,
            self:: MENUNGGU->value
        ];
    }
}

