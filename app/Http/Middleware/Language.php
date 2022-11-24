<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (strpos(request()->getRequestUri(), 'api') == true) {

            $header_lang =  $_SERVER['HTTP_LANG'] ?? null;
            $lang = ['id', 'en'];
            if (in_array($header_lang, $lang) == false) {
                $response = [
                    'status' => false,
                    'message' => 'Data tidak valid',
                ];

                return response()->json($response, 400);
            } else {
                return $next($request);
            }
        }
    }
}
