<?php

if (! function_exists('caesarEncode')) {
    function caesarEncode($string, $shift)
    {
        $result = '';
        foreach (str_split($string) as $char) {
            if (ctype_alpha($char)) {
                $code = ord($char);
                $base = ctype_lower($char) ? 97 : 65;
                $result .= chr(($code - $base + $shift) % 26 + $base);
            } else {
                $result .= $char;
            }
        }
        return $result;
    }
}

if (! function_exists('caesarDecode')) {
    function caesarDecode($string, $shift)
    {
        return caesarEncode($string, 26 - $shift); // reverse the encoding
    }
}
