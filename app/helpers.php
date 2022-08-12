<?php

if (!function_exists('notice')) {
    function notice(string $message, string $type)
    {
        $sessionName = 'notice' . $type;
        session([$sessionName => $message]);
    }
}
