<?php

namespace App\Http\Middleware;

use App\Models\Aplikasi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AplikasiData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $title = Aplikasi::first();
        $foter = Aplikasi::first();
        $logo = Aplikasi::first();

        view()->share('title', $title);
        view()->share('foter', $foter);
        view()->share('logo', $logo);

        return $next($request);
    }
}
