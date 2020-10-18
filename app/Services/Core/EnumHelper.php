<?php


namespace App\Services\Core;


class EnumHelper
{
    public static function actorPermissions():array
    {
        return [
            'user',
            'client'
        ];
    }

    public static function purchaseStatuses():array
    {
        return [
            'pending',
            'accepted',
            'cancelled'
        ];
    }
}
