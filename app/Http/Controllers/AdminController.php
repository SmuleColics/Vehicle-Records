<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  public function showDashboard()
  {
    $userCount = User::count();
    $vehicleCount = Vehicle::count();

    $monthlyData = collect(range(1, 12))->map(
      fn($m) =>
      Vehicle::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->count()
    );

    $byType = Vehicle::selectRaw('type, COUNT(*) as count')
      ->groupBy('type')
      ->pluck('count', 'type');

    return view('admin.dashboard', compact('userCount', 'vehicleCount', 'monthlyData', 'byType'));
  }

  // ========== USERS ==========

  public function showUsers()
  {
    // get all users in the db
    $users = User::withCount('vehicles')->get();

    // gagawing associate array
    return view('admin.users', compact('users'));
  }

  public function addUser(Request $request)
  {
    if (User::where('email', $request->email)->exists()) {
      return back()->with('error', 'Account already exists');
    }

    if ($request->password !== $request->confirm_password) {
      return back()->with('error', 'Passwords do not match');
    }

    User::create([
      'name'     => $request->name,
      'email'    => $request->email,
      'password' => Hash::make($request->password),
      'role'     => $request->role === User::ROLE_ADMIN ? User::ROLE_ADMIN : User::ROLE_CLIENT,
    ]);

    session()->forget('error');
    return back()->with('success', 'User added successfully.');
  }

  public function editUser(Request $request, $id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return back()->with('error', 'User not found');
    }

    if ($user->isDemo()) {
      return back()->with('error', 'Demo accounts cannot be edited');
    }

    if (User::where('email', $request->email)->where('id', '!=', $id)->exists()) {
      return back()->with('error', 'Account already exists');
    }

    $user->name  = $request->name;
    $user->email = $request->email;

    // admins can't demote themselves, otherwise they'd lock themselves out
    if ($user->id != session('user')->id) {
      $user->role = $request->role === User::ROLE_ADMIN ? User::ROLE_ADMIN : User::ROLE_CLIENT;
    }

    if ($request->filled('new_password')) {
      if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect');
      }

      if ($request->new_password !== $request->confirm_password) {
        return back()->with('error', 'Passwords do not match');
      }

      $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return back()->with('success', 'User updated successfully');
  }

  public function deleteUser($id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return back()->with('error', 'User not found');
    }

    if ($user->isDemo()) {
      return back()->with('error', 'Demo accounts cannot be deleted');
    }

    if ($user->id == session('user')->id) {
      return back()->with('error', 'You cannot delete your own account');
    }

    $user->delete();

    return back()->with('success', 'User deleted successfully');
  }
}
