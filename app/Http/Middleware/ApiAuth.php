<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;

class ApiAuth
{

    protected function handleFail()
    {
        return response('Unauthorized', 401);
    }

    public function handle($request, Closure $next, $guard = null, $class = 'App\Client', $auth = 'bearer')
    {
        if ($auth === 'bearer') {
            $model = forward_static_call([$class, 'where'], 'api_token', $request->bearerToken())->first();
            if (!$model || !$model->isTokenValid()) {
                return $this->handleFail();
            }
        } else {
            $model = forward_static_call([$class, 'where'], 'login', $request->getUser())->first();
            if (!Hash::check($request->getPassword(), $model->password)) {
                return $this->handleFail();
            }
        }
        return $next($request);
    }
}
