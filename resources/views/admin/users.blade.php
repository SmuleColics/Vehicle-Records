@extends('layouts.main')

@section('title', 'Users')

@section('content')

    <!-- HEADER -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="fw-bold fs-4 mb-1">Users</h1>
            <p class="text-secondary small mb-0">Manage everyone with access to your workspace.</p>
        </div>
        <button class="btn btn-dark btn-sm rounded-3 d-flex align-items-center gap-2 fw-semibold" data-bs-toggle="modal"
            data-bs-target="#addUserModal">
            <i class="bi bi-plus-lg"></i> Add user
        </button>
    </div>

    <!-- TABLE -->
    <div class="rounded-4 border overflow-hidden bg-white p-3">
        <table id="usersTable" class="table table-hover mb-0 small">
            <thead class="table-light text-uppercase text-secondary" style="font-size:0.7rem;letter-spacing:0.05em;">
                <tr>
                    <th class="px-4 py-3 fw-semibold">ID</th>
                    <th class="px-4 py-3 fw-semibold">Full Name</th>
                    <th class="px-4 py-3 fw-semibold">Email</th>
                    <th class="px-4 py-3 fw-semibold">Created Date</th>
                    <th class="px-4 py-3 fw-semibold text-end" style="width:120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-3 fw-medium">{{ $user->id }}</td>
                        <td class="px-4 py-3 text-secondary">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-secondary">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-secondary">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="d-flex justify-content-end gap-1">
                                <button class="btn btn-sm btn-light rounded-3 p-2 d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                    <i class="bi bi-pencil" style="font-size:0.75rem;"></i>
                                </button>
                                <button class="btn btn-sm btn-light rounded-3 p-2 d-flex align-items-center text-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
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
    @foreach ($users as $user)
        <!-- EDIT USER MODAL -->
        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 overflow-hidden">
                    <div class="modal-header border-0 px-4 pt-4 pb-0">
                        <h5 class="modal-title fw-bold">Edit user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="{{ route('editUser', $user->id) }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-body px-4 py-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small fw-medium">Full name</label>
                                    <input type="text" name="name" class="form-control form-control-sm py-2"
                                        value="{{ $user->name }}" placeholder="James Macalintal" required />
                                    <div class="invalid-feedback">Name is required.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-medium">Email</label>
                                    <input type="email" name="email" class="form-control form-control-sm py-2"
                                        value="{{ $user->email }}" placeholder="james@gmail.com" required />
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-4 pt-0">
                            <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DELETE MODAL -->
        <!-- DELETE MODAL -->
        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 rounded-4 overflow-hidden">
                    <div class="modal-header border-0 px-4 pt-4 pb-0">
                        <h5 class="modal-title fw-bold">Delete user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4 py-3">
                        <p class="small text-secondary mb-0">Are you sure you want to delete
                            <strong>{{ $user->name }}</strong>? This action cannot be undone.
                        </p>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('deleteUser', $user->id) }}"
                            class="btn btn-danger btn-sm rounded-3 px-4 fw-semibold">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ADD USER MODAL -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header border-0 px-4 pt-4 pb-0">
                    <h5 class="modal-title fw-bold">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('addUser') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body px-4 py-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-medium">Full name</label>
                                <input type="text" name="name" class="form-control form-control-sm py-2"
                                    placeholder="James Macalintal" value="{{ old('name') }}" required />
                                <div class="invalid-feedback">Full name is required.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-medium">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm py-2"
                                    placeholder="james@gmail.com" value="{{ old('email') }}" required />
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-medium">Password</label>
                                <div class="input-group input-group-sm">
                                    <input type="password" id="modalPassword" name="password" class="form-control py-2"
                                        placeholder="At least 6 characters" minlength="6" required />
                                    <button class="btn btn-light border" type="button" id="modalTogglePassword">
                                        <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                                    </button>
                                    <div class="invalid-feedback">Password must be at least 6 characters.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-medium">Confirm password</label>
                                <div class="input-group input-group-sm">
                                    <input type="password" id="modalConfirmPassword" name="confirm_password"
                                        class="form-control py-2" placeholder="Confirm password" required />
                                    <button class="btn btn-light border" type="button" id="modalTogglePasswordConfirm">
                                        <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                                    </button>
                                    <div class="invalid-feedback">Passwords do not match.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold">Create
                            account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/tables.js') }}"></script>
    <script src="{{ asset('js/admin/users.js') }}"></script>
@endsection
