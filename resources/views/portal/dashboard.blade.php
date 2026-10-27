@extends('layouts.main')

@section('title', 'My Garage')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
@endsection

@section('content')

    <!-- HEADER -->
    <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold fs-4 mb-1">Welcome back, {{ strtok(session('user')->name, ' ') }}</h1>
            <p class="text-secondary small mb-0">Here's what's parked in your garage.</p>
        </div>
        <a href="{{ route('vehicles') }}"
            class="btn btn-dark btn-sm rounded-3 d-flex align-items-center gap-2 fw-semibold">
            <i class="bi bi-plus-lg"></i> Manage vehicles
        </a>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <a href="{{ route('vehicles') }}"
                class="stat-card stat-card-link d-block text-reset text-decoration-none rounded-4 border p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="text-secondary small mb-0">My Vehicles</p>
                    <span class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-car-front"></i>
                    </span>
                </div>
                <p class="fw-bold mb-1" style="font-size:1.75rem;">{{ $vehicleCount }}</p>
                <p class="text-secondary small mb-0">Registered to your account <i class="bi bi-arrow-right stat-card-arrow"></i></p>
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('vehicles', ['search' => date('Y')]) }}"
                class="stat-card stat-card-link d-block text-reset text-decoration-none rounded-4 border p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="text-secondary small mb-0">Added in {{ date('Y') }}</p>
                    <span class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                </div>
                <p class="fw-bold mb-1" style="font-size:1.75rem;">{{ $thisYearCount }}</p>
                <p class="text-secondary small mb-0">New records this year <i class="bi bi-arrow-right stat-card-arrow"></i></p>
            </a>
        </div>
        <div class="col-12 col-md-4">
            @php($topType = $byType->sort()->keys()->last())
            <a href="{{ route('vehicles', $topType ? ['search' => $topType] : []) }}"
                class="stat-card stat-card-link d-block text-reset text-decoration-none rounded-4 border p-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="text-secondary small mb-0">Most common type</p>
                    <span class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-tags"></i>
                    </span>
                </div>
                <p class="fw-bold mb-1" style="font-size:1.75rem;">{{ $topType ?? '—' }}</p>
                <p class="text-secondary small mb-0">Across your vehicles <i class="bi bi-arrow-right stat-card-arrow"></i></p>
            </a>
        </div>
    </div>

    <!-- CHARTS ROW -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="rounded-4 border p-4 bg-white h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="fw-semibold fs-6 mb-0">Vehicles added per month</h2>
                    <span class="text-secondary small">{{ date('Y') }}</span>
                </div>
                <canvas id="recordsChart" height="120"></canvas>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="rounded-4 border p-4 bg-white h-100">
                <h2 class="fw-semibold fs-6 mb-4">By vehicle type</h2>
                @if ($vehicleCount)
                    <div class="mx-auto" style="max-width: 220px;">
                        <canvas id="typeChart"></canvas>
                    </div>
                    {{-- same colour order as dashboard.js --}}
                    @php($colors = ['#C9A84C', '#6c757d', '#adb5bd', '#dee2e6', '#111111'])
                    <div class="row g-2 mt-3">
                        @foreach ($byType as $type => $count)
                            <div class="col-6 d-flex align-items-center gap-2 small">
                                <span class="chart-dot" style="background:{{ $colors[$loop->index % count($colors)] }};"></span>
                                {{ $type }} ({{ $count }})
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-secondary small mb-0">Add your first vehicle to see the breakdown.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- RECENT VEHICLES -->
    <div class="rounded-4 border bg-white p-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="fw-semibold fs-6 mb-0">Recently added</h2>
            <a href="{{ route('vehicles') }}" class="small text-secondary text-decoration-none">View all</a>
        </div>
        @forelse ($recentVehicles as $vehicle)
            <div class="d-flex align-items-center justify-content-between py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                <div class="d-flex align-items-center gap-3">
                    <span class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-car-front"></i>
                    </span>
                    <div>
                        <p class="small fw-semibold mb-0">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                        <p class="text-secondary mb-0" style="font-size:0.75rem;">{{ $vehicle->plate }} · {{ $vehicle->year }}</p>
                    </div>
                </div>
                <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis fw-normal">{{ $vehicle->type }}</span>
            </div>
        @empty
            <p class="text-secondary small mb-0">No vehicles yet.
                <a href="{{ route('vehicles') }}" class="text-dark fw-semibold">Add one</a> to get started.</p>
        @endforelse
    </div>

@endsection

@section('scripts')
    <script>
        const monthlyData = {!! $monthlyData !!};
        const typeData = {!! $byType !!};
    </script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection
