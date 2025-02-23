<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function parse(?string $date, string $format = 'Y-m-d')
    {
        if ($date != null) {
            return Carbon::createFromFormat($format, $date);
        }
    }

    public static function compareDates(array $period)
    {
        $diff = self::diffDates($period[0], $period[1]);

        if ($diff < 0) {
            return false;
        }

        return true;
    }

    public static function diffDates(Carbon $date1, Carbon $date2)
    {
        return $date1->diffInDays($date2, false);
    }
}
