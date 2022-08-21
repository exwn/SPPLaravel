<?php

if (!function_exists('format_idr')) {
    function format_idr($val)
    {
        return number_format($val, 0, ',', '.');
    }
}
