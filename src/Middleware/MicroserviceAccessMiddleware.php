<?php

namespace Ashr\Starter\Middleware;

use Ashr\Starter\Support\Facades\MicroserviceServiceLayer;
use Closure;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MicroserviceAccessMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
       $response = MicroserviceServiceLayer::userCanAccess($permission);

       if ($response->status() !== HttpResponse::HTTP_OK) {
           return response()->json($response->json(), $response->status());
       }

       return $next($request);
    }
}