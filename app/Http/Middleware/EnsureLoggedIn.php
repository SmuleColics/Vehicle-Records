<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureLoggedIn
{
  public function handle(Request $request, Closure $next)
  {
    if (!session('user')) {
      return redirect()->route('login')->with('error', 'Please log in first');
    }

    // reload the user so role and profile changes made by others show up right away
    $user = User::find(session('user')->id);

    if (!$user) {
      session()->forget('user');
      return redirect()->route('login')->with('error', 'Your account no longer exists');
    }

    session(['user' => $user]);

    return $next($request);
  }
}
