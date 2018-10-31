<?php

namespace techadmin\middleware;

use techadmin\service\auth\facade\Auth;

class AuthCheck
{
    public function handle($request, \Closure $next)
    {
        if (Auth::guard()->guest()) {
            return redirect('techadmin.auth.passport.login');
        }

        return $next($request);
    }
}
