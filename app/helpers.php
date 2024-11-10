<?php

if (! function_exists('convertToCents')) {
    function convertToCents(string $dollar): int {
        $dollar = preg_replace("/[^\d.]/", "", $dollar);
        return intval(round(floatval($dollar) * 100));
    }
}

if (! function_exists('extractUuid')) {
    function extractUuid(string $value): bool | string {
        $pattern = '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i';

        if (preg_match($pattern, $value, $matches)) {
            return $matches[0];
        }

        return false;
    }
}
