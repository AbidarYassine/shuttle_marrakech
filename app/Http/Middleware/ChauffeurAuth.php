<?php

namespace App\Http\Middleware;

use Closure;

class ChauffeurAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->get('id')) {
            return redirect()->route('chauffeur.demande');
        }
        return $next($request);
    }
}
