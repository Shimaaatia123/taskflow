<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (! in_array($locale, ['ar', 'en'], true)) {
            $locale = config('app.locale', 'en');
        }

        LaravelLocalization::setLocale($locale);

        return $next($request);
    }
}