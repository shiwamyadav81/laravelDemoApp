<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Fortify;
use App\Events\RealtimeMessageEvent;
use Laravel\Fortify\Actions\AttemptToAuthenticate;


class CustomAttemptToAuthenticate extends AttemptToAuthenticate
{
    public function handle($request, $next)
    {
        if (Fortify::$authenticateUsingCallback) {
            return $this->handleUsingCustomCallback($request, $next);
        }

        if ($this->guard->attempt(
            $request->only(Fortify::username(), 'password'),
            $request->boolean('remember')
        )) {
            event(new RealtimeMessageEvent($request->email . ' Logged-In.'));
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }
}
