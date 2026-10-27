<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
  public function handle(Request $request, Closure $next)
  {
    if (!session('user')->isAdmin()) {
      return redirect()->route('portal')->with('error', 'Only admins can open that page');
    }

    return $next($request);
  }
}
