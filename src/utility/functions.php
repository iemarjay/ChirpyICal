<?php

if (!function_exists('validDuration'))
{
    function validDuration($duration)
    {
        preg_match('/^\d+H\d+M\d+S/', $duration, $match);

        return !empty(count($match));
    }
}

if (!function_exists('propExists'))
{
    function propExists($prop, $string)
    {
        if ($string)
        {
            preg_match("/$prop/", $string, $count);

            return !empty(count($count));
        }

        return false;
    }
}

if (!function_exists('iCalTimeFormat'))
{
    function iCalTimeFormat($dateTime)
    {
        if ($dateTime && $dateTime instanceof DateTime)
        {
            return "{$dateTime->format('Ymd')}T{$dateTime->format('His')}";
        }

        $dateTime   = new DateTime($dateTime);

        return "{$dateTime->format('Ymd')}T{$dateTime->format('His')}";
    }
}


