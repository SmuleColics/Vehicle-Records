@extends('layouts.main')

@section('title', 'Vehicle Records')

@section('content')

    <!-- HEADER -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="fw-bold fs-4 mb-1">Vehicle Records</h1>
            <p class="text-secondary small mb-0">All flood control vehicles you've added to your workspace.</p>
        </div>
        <button class="btn btn-dark btn-sm rounded-3 d-flex align-items-center gap-2 fw-semibold" data-bs-toggle="modal"
            data-bs-target="#addModal">
            <i class="bi bi-plus-lg"></i> Add vehicle
        </button>
    </div>

    <!-- TABLE -->
    <div class="rounded-4 border overflow-hidden bg-white p-3">
        <table id="vehiclesTable" class="table table-hover mb-0 small">
            <thead class="table-light text-uppercase text-secondary" style="font-size:0.7rem;letter-spacing:0.05em;">
                <tr>
                    <th class="px-4 py-3 fw-semibold">Plate</th>
                    <th class="px-4 py-3 fw-semibold">Brand</th>
                    <th class="px-4 py-3 fw-semibold">Model</th>
                    <th class="px-4 py-3 fw-semibold">Year</th>
                    <th class="px-4 py-3 fw-semibold">Type</th>
                    <th class="px-4 py-3 fw-semibold">Created Date</th>
                    <th class="px-4 py-3 fw-semibold text-end" style="width:100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td class="px-4 py-3 fw-medium">{{ $vehicle->plate }}</td>
                        <td class="px-4 py-3 text-secondary">{{ $vehicle->brand }}</td>
                        <td class="px-4 py-3 text-secondary">{{ $vehicle->model }}</td>
                        <td class="px-4 py-3 text-secondary">{{ $vehicle->year }}</td>
                        <td class="px-4 py-3">
                            <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis fw-normal">
                                {{ $vehicle->type }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-secondary">{{ $vehicle->created_at }}</td>
                        <td class="px-4 py-3">
                            <div class="d-flex justify-content-end gap-1">
                                <button class="btn btn-sm btn-light rounded-3 p-2 d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $vehicle->id }}">
                                    <i class="bi bi-pencil" style="font-size:0.75rem;"></i>
                                </button>
                                <button class="btn btn-sm btn-light rounded-3 p-2 d-flex align-items-center text-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $vehicle->id }}">
                                    <i class="bi bi-trash3" style="font-size:0.75rem;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- EDIT AND DELETE MODAL --}}
    @foreach ($vehicles as $vehicle)

        <!-- EDIT VEHICLE MODAL -->
        <div class="modal fade" id="editModal{{ $vehicle->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden">
                    <div class="modal-header border-0 px-4 pt-4 pb-0">
                        <h5 class="modal-title fw-bold">Edit vehicle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="{{ route('editVehicle', $vehicle->id) }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-body px-4 py-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label small fw-medium">Plate</label>
                                    <input type="text" name="plate"
                                        class="form-control form-control-sm py-2"
                                        value="{{ $vehicle->plate }}" placeholder="ABC-1234" required />
                                    <div class="invalid-feedback">Plate number is required.</div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-medium">Brand</label>
                                    <input type="text" name="brand"
                                        class="form-control form-control-sm py-2"
                                        value="{{ $vehicle->brand }}" placeholder="Toyota" required />
                                    <div class="invalid-feedback">Brand is required.</div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-medium">Model</label>
                                    <input type="text" name="model"
                                        class="form-control form-control-sm py-2"
                                        value="{{ $vehicle->model }}" placeholder="Vios" required />
                                    <div class="invalid-feedback">Model is required.</div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-medium">Year</label>
                                    <input type="number" name="year"
                                        class="form-control form-control-sm py-2"
                                        value="{{ $vehicle->year }}" placeholder="2024" min="1900" max="2099" required />
                                    <div class="invalid-feedback">Year is required.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-medium">Type</label>
                                    <select name="type" class="form-select form-select-sm py-2" required>
                                        <option value="Sedan" {{ $vehicle->type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                        <option value="SUV" {{ $vehicle->type == 'SUV' ? 'selected' : '' }}>SUV</option>
                                        <option value="Truck" {{ $vehicle->type == 'Truck' ? 'selected' : '' }}>Truck</option>
                                        <option value="Van" {{ $vehicle->type == 'Van' ? 'selected' : '' }}>Van</option>
                                        <option value="Motorcycle" {{ $vehicle->type == 'Motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-4 pt-0">
                            <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit"
                                class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DELETE VEHICLE MODAL -->
        <div class="modal fade" id="deleteModal{{ $vehicle->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 rounded-4 overflow-hidden">
                    <div class="modal-header border-0 px-4 pt-4 pb-0">
                        <h5 class="modal-title fw-bold">Delete vehicle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4 py-3">
                        <p class="small text-secondary mb-0">Are you sure you want to delete
                            <strong>{{ $vehicle->plate }}</strong>? This action cannot be undone.
                        </p>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('deleteVehicle', $vehicle->id) }}"
                            class="btn btn-danger btn-sm rounded-3 px-4 fw-semibold">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    <!-- ADD VEHICLE MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header border-0 px-4 pt-4 pb-0">
                    <h5 class="modal-title fw-bold">Add vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('addVehicle') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body px-4 py-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-medium">Plate</label>
                                <input type="text" name="plate"
                                    class="form-control form-control-sm py-2"
                                    placeholder="ABC-1234" required />
                                <div class="invalid-feedback">Plate number is required.</div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-medium">Brand</label>
                                <input type="text" name="brand"
                                    class="form-control form-control-sm py-2"
                                    placeholder="Toyota" required />
                                <div class="invalid-feedback">Brand is required.</div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-medium">Model</label>
                                <input type="text" name="model"
                                    class="form-control form-control-sm py-2"
                                    placeholder="Vios" required />
                                <div class="invalid-feedback">Model is required.</div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-medium">Year</label>
                                <input type="number" name="year"
                                    class="form-control form-control-sm py-2"
                                    placeholder="2024" min="1900" max="2099" required />
                                <div class="invalid-feedback">Year is required.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-medium">Type</label>
                                <select name="type" class="form-select form-select-sm py-2" required>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Truck">Truck</option>
                                    <option value="Van">Van</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/tables.js') }}"></script>
    <script src="{{ asset('js/admin/vehicles.js') }}"></script>
@endsection