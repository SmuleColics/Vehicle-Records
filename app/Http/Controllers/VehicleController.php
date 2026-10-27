<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

// admins manage every vehicle, clients only see and manage their own
class VehicleController extends Controller
{
  private function visibleVehicles()
  {
    $user = session('user');

    return $user->isAdmin() ? Vehicle::query() : Vehicle::where('user_id', $user->id);
  }

  public function showVehicles()
  {
    $vehicles = $this->visibleVehicles()->with('user')->latest()->get();

    // admins can pick who owns a new vehicle
    $owners = session('user')->isAdmin() ? User::orderBy('name')->get(['id', 'name', 'email']) : collect();

    return view('shared.vehicles', compact('vehicles', 'owners'));
  }

  public function addVehicle(Request $request)
  {
    if (Vehicle::where('plate', $request->plate)->exists()) {
      return back()->with('error', 'Plate number already exists');
    }

    $ownerId = session('user')->id;

    if (session('user')->isAdmin() && User::where('id', $request->user_id)->exists()) {
      $ownerId = $request->user_id;
    }

    Vehicle::create([
      'user_id' => $ownerId,
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
    $vehicle = $this->visibleVehicles()->where('id', $id)->first();

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
    $vehicle = $this->visibleVehicles()->where('id', $id)->first();

    if (!$vehicle) {
      return back()->with('error', 'Vehicle not found');
    }

    $vehicle->delete();

    return back()->with('success', 'Vehicle deleted successfully');
  }
}
