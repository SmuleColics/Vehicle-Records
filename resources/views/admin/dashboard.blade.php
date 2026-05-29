@extends('layouts.main')

@section('title', 'Dashboard')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
@endsection

@section('content')

    <div class="mb-4">
        <h1 class="fw-bold fs-4 mb-1">Dashboard</h1>
        <p class="text-secondary small mb-0">A quick look at your vehicle records.</p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="stat-card rounded-4 border p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="text-secondary small mb-0">Total Users</p>
                    <span class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </span>
                </div>
                <p class="fw-bold mb-1" style="font-size:1.75rem;">{{ $userCount }}</p>
                <p class="text-secondary small mb-0">Registered accounts</p>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="stat-card rounded-4 border p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="text-secondary small mb-0">Vehicle Records</p>
                    <span class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-car-front"></i>
                    </span>
                </div>
                <p class="fw-bold mb-1" style="font-size:1.75rem;">{{ $vehicleCount }}</p>
                <p class="text-secondary small mb-0">Total vehicles logged</p>
            </div>
        </div>
    </div>

    <!-- CHARTS ROW -->
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="rounded-4 border p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="fw-semibold fs-6 mb-0">Vehicles added per month</h2>
                    <span class="text-secondary small">2025</span>
                </div>
                <canvas id="recordsChart" height="120"></canvas>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="rounded-4 border p-4 bg-white h-100">
                <h2 class="fw-semibold fs-6 mb-4">By vehicle type</h2>
                <canvas id="typeChart"></canvas>
                <div class="row g-2 mt-3">
                    <div class="col-6 d-flex align-items-center gap-2 small">
                        <span class="chart-dot" style="background:#C9A84C;"></span> Sedan
                    </div>
                    <div class="col-6 d-flex align-items-center gap-2 small">
                        <span class="chart-dot" style="background:#6c757d;"></span> SUV
                    </div>
                    <div class="col-6 d-flex align-items-center gap-2 small">
                        <span class="chart-dot" style="background:#adb5bd;"></span> Truck
                    </div>
                    <div class="col-6 d-flex align-items-center gap-2 small">
                        <span class="chart-dot" style="background:#dee2e6;"></span> Van
                    </div>
                    <div class="col-6 d-flex align-items-center gap-2 small">
                        <span class="chart-dot" style="background:#111111;"></span> Motorcycle
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const monthlyData = {!! $monthlyData !!};
        const typeData = {!! $byType !!};
    </script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection