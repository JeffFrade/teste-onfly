<?php

namespace App\Core\Middleware;

use Illuminate\Http\Request;

/**
 * @codeCoverageIgnore
 */
class AlwaysExpectsJson
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $request->headers->add(['Accept' => 'application/json']);

        return $next($request);
    }
}
