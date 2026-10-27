<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Vercel terminates HTTPS in front of the app, trust it so asset() builds https:// links
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'loggedin' => \App\Http\Middleware\EnsureLoggedIn::class,
            'admin' => \App\Http\Middleware\EnsureAdmin::class,
        ]);

        // the demo buttons only sign in to the shared demo accounts, so a stale page
        // (back button, tab left open) shouldn't fail with "419 Page Expired"
        $middleware->validateCsrfTokens(except: ['demo/*']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // any other form submitted after the session expired: go back and ask to retry
        $exceptions->render(function (HttpException $e) {
            if ($e->getStatusCode() === 419) {
                return redirect()->back()->with('error', 'Your session expired. Please try again.');
            }
        });
    })->create();
