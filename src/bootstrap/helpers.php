<?php
/** Global functions defined here **/

if (!function_exists('env'))
{
    function env($key, $default = null)
    {
        if (!isset($_ENV[$key])) return $default;
        return $_ENV[$key];
    }
}
