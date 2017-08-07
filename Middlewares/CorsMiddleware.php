<?php

namespace Ansta\LaraCms\Middlewares;

use Closure;
use Illuminate\Http\Response;

/**
 * Class CorsMiddleware
 * @package Ansta\LaraCms\Middlewares
 */
class CorsMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return Response|mixed
     */
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin: '.implode(', ', config('laracms.allowed_origins')));

        $headers = config('laracms.cors_headers');

        if ($request->getMethod() == 'OPTIONS') {
            return new Response('OK', 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value) {
            $response->header($key, $value);
        }
        return $response;
    }
}
