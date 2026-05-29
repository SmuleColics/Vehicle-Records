<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

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

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    return back()->with('success', 'Account created successfully');
  }

  public function showLogin()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return back()->with('error', 'Invalid credentials');
    }

    session(['user' => $user]);

    return redirect()->route('dashboard')->with('success', 'Logged in successfully');
  }

}
