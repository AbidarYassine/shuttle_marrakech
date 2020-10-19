<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;
use LaravelLocalization;
use Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Str::is(LaravelLocalization::setLocale() . '/admin/*', $request->path())) {
                return route('admin.get.login');
            } else
                return route('login');
        }
    }
}
