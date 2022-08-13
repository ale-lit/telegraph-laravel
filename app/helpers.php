<?php

use Illuminate\Support\Facades\Hash;

if (! function_exists('notice')) {
    function notice(string $message, string $type): void
    {
        $sessionName = 'notice' . $type;
        session([$sessionName => $message]);
    }
}

if (! function_exists('checkAccess')) {
    function checkAccess(string $slug, string $token): bool
    {
        return Hash::check(config('app.key') . $slug, $token);
    }
}
