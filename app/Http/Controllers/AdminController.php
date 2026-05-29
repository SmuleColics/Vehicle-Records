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
    $users = User::all();

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

    if (User::where('email', $request->email)->where('id', '!=', $id)->exists()) {
      return back()->with('error', 'Account already exists');
    }

    $user->update([
      'name' => $request->name,
      'email' => $request->email,
    ]);

    return back()->with('success', 'User updated successfully');
  }

  public function deleteUser($id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return back()->with('error', 'User not found');
    }

    $user->delete();

    return back()->with('success', 'User deleted successfully');
  }

  // ========== VEHICLES ========== 

  public function showVehicles()
  {
    $vehicles = Vehicle::where('user_id', session('user')->id)->get();

    return view('admin.vehicles', compact('vehicles'));
  }

  public function addVehicle(Request $request)
  {
    if (Vehicle::where('plate', $request->plate)->exists()) {
      return back()->with('error', 'Plate number already exists');
    }

    Vehicle::create([
      'user_id' => session('user')->id,
      'plate'   => $request->plate,
      'brand'   => $request->brand,
      'model'   => $request->model,
      'year'    => $request->year,
      'type'    => $request->type,
    ]);

    return back()->with('success', 'Vehicle added successfully');
  }

  public function editVehicle(Request $request, $id)
  {
    $vehicle = Vehicle::where('id', $id)->where('user_id', session('user')->id)->first();

    if (!$vehicle) {
      return back()->with('error', 'Vehicle not found');
    }

    if (Vehicle::where('plate', $request->plate)->where('id', '!=', $id)->exists()) {
      return back()->with('error', 'Plate number already exists');
    }

    $vehicle->update([
      'plate' => $request->plate,
      'brand' => $request->brand,
      'model' => $request->model,
      'year'  => $request->year,
      'type'  => $request->type,
    ]);

    return back()->with('success', 'Vehicle updated successfully');
  }

  public function deleteVehicle($id)
  {
    $vehicle = Vehicle::where('id', $id)->where('user_id', session('user')->id)->first();

    if (!$vehicle) {
      return back()->with('error', 'Vehicle not found');
    }

    $vehicle->delete();

    return back()->with('success', 'Vehicle deleted successfully');
  }

  // ========== PROFILE ========== 

  public function showProfile()
  {
    $user = User::find(session('user')->id);

    return view('admin.profile', compact('user'));
  }

  public function updateProfilePicture(Request $request)
  {
    $user = User::find(session('user')->id);

    if (!$request->hasFile('profile')) {
      return back()->with('error', 'Please select a photo to upload.');
    }

    $file = $request->file('profile');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads'), $filename);
    $user->profile_picture = $filename;
    $user->save();

    session(['user' => $user]);

    return back()->with('success', 'Profile picture updated successfully');
  }

  public function updateProfile(Request $request)
  {
    $user = User::find(session('user')->id);

    // Update personal details
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->gender = $request->gender;
    $user->address = $request->address;

    // Update password only if new password is provided
    if ($request->new_password) {
      if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect');
      }

      if ($request->new_password !== $request->confirm_password) {
        return back()->with('error', 'New passwords do not match');
      }

      $user->password = Hash::make($request->new_password);
    }

    $user->save();

    session(['user' => $user]);

    return back()->with('success', 'Profile updated successfully');
  }

  public function logout()
  {
    session()->forget('user');

    return redirect()->route('login')->with('success', 'Logged out successfully');
  }
}
