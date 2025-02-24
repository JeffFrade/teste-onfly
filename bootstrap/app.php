<?php

use App\Core\Middleware\AlwaysExpectsJson;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            AlwaysExpectsJson::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
