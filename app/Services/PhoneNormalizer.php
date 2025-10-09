<?php

namespace App\Services;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class PhoneNormalizer
{
    public static function normalize(string $phone, string $defaultRegion = 'ES'): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $number = $phoneUtil->parse($phone, $defaultRegion);
        return $phoneUtil->format($number, PhoneNumberFormat::E164);
    }
}