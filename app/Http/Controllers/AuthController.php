<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function showRegister()
  {
    return view('auth.register');
  }

  public function register(Request $request)
  {
    if (User::where('email', $request->email)->exists()) {
      return back()->with('error', 'Account already exists');
    }

    if ($request->password !== $request->confirm_password) {
      return back()->with('error', 'Passwords do not match');
    }

    // new sign ups always get the client portal, admins are created by other admins
    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => User::ROLE_CLIENT,
    ]);

    return redirect()->route('login')->with('success', 'Account created successfully. You can now log in.');
  }

  public function showLogin()
  {
    if (session('user')) {
      return redirect(session('user')->homeRoute());
    }

    return view('auth.login');
  }

  public function login(Request $request)
  {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return back()->with('error', 'Invalid credentials');
    }

    session()->regenerate();
    session(['user' => $user]);

    return redirect($user->homeRoute())->with('success', 'Logged in successfully');
  }

  // one-click login for portfolio visitors, only when DEMO_MODE is on
  public function demoLogin($role)
  {
    abort_unless(config('demo.enabled'), 404);

    $user = User::where('email', config("demo.accounts.$role"))->first();

    if (!$user) {
      return redirect()->route('login')->with('error', 'Demo account is not set up yet. Run php artisan db:seed');
    }

    session()->regenerate();
    session(['user' => $user]);

    return redirect($user->homeRoute())->with('success', 'Welcome! You are exploring the ' . $role . ' demo.');
  }

  public function logout()
  {
    session()->forget('user');
    session()->regenerate();

    return redirect()->route('login')->with('success', 'Logged out successfully');
  }
}
