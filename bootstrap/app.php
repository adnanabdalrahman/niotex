<?php

use App\Exceptions\AdresseGesperrtException;
use App\Exceptions\AdresseNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $ex) {
        $ex->report(function (AdresseNotFoundException $e) {
            \Log::error($e->getMessage());
        })->stop();
        $ex->renderable(function (AdresseNotFoundException $e, Request $req) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        });
        //----------------------------------------------
        $ex->report(function (AdresseGesperrtException $e) {
            \Log::error($e->getMessage());
        })->stop();
        $ex->renderable(function (AdresseGesperrtException $e, Request $req) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        });
        //----------------------------------------------


    })
    ->create();
