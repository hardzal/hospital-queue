<?php

if (!function_exists('expandingNumberSize')) {
    function expandingNumberSize($number)
    {
        $strsize = strlen($number);
        for ($i = 3; $i > $strsize; $i--) {
            $number .= "0";
        }

        return strrev($number);
    }
}
