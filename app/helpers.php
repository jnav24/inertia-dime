<?php

if (! function_exists('convertToCents')) {
    function convertToCents(string $dollar): int {
        $dollar = preg_replace("/[^\d.]/", "", $dollar);
        return intval(round(floatval($dollar) * 100));
    }
}
