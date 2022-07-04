<?php

namespace App\Helpers;

class Helper
{
    private static function getShortUri(): string
    {
        $shortened = [];
        $shortenedLength = 6;
        $lower = range('a', 'z');
        $upper = range('A', 'Z');
        $digits = range(0, 9);
        $dictionary = array_merge($lower, $upper, $digits);
        for ($i = 0; $i < $shortenedLength; $i++) {
            $shortened[] = $dictionary[array_rand($dictionary)];
        }
        return implode('', $shortened);
    }

    public static function getShortUrl(): string
    {
        $host = url()->current();
        $uri = self::getShortUri();
        return "{$host}/{$uri}";
    }
}
