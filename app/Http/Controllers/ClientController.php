<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class ClientController extends Controller
{
  public function showDashboard()
  {
    $userId = session('user')->id;

    $vehicleCount = Vehicle::where('user_id', $userId)->count();

    $thisYearCount = Vehicle::where('user_id', $userId)->whereYear('created_at', date('Y'))->count();

    $monthlyData = collect(range(1, 12))->map(
      fn($m) =>
      Vehicle::where('user_id', $userId)->whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->count()
    );

    $byType = Vehicle::where('user_id', $userId)
      ->selectRaw('type, COUNT(*) as count')
      ->groupBy('type')
      ->pluck('count', 'type');

    $recentVehicles = Vehicle::where('user_id', $userId)->latest()->take(5)->get();

    return view('portal.dashboard', compact('vehicleCount', 'thisYearCount', 'monthlyData', 'byType', 'recentVehicles'));
  }
}
