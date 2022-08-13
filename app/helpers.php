<?php

use Illuminate\Support\Facades\Hash;

if (! function_exists('notice')) {
    function notice(string $message, string $type = 'success'): void
    {
        $message = $type . '-' .  $message;
        session(['notice' => $message]);
    }
}

if (! function_exists('checkAccess')) {
    function checkAccess(string $slug): bool
    {
        if ($token = request()->cookie($slug)) {
            return Hash::check(config('app.key') . $slug, $token);
        } else {
            return false;
        }
    }
}
