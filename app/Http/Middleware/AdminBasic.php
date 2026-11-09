<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminBasic
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = (string) $request->getUser();
        $pass = (string) $request->getPassword();

        if (hash_equals((string) config('assetcare.user'), $user)
            && hash_equals((string) config('assetcare.pass'), $pass)) {
            return $next($request);
        }

        return response('Login required', 401, ['WWW-Authenticate' => 'Basic realm="AssetCare"']);
    }
}