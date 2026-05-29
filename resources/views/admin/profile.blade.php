@extends('layouts.main')

@section('title', 'Profile')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}">
@endsection

@section('content')

    <!-- HEADER -->
    <div class="mb-4">
        <h1 class="fw-bold fs-4 mb-1">Profile</h1>
        <p class="text-secondary small mb-0">Your account information.</p>
    </div>

    <!-- GRID -->
    <div class="row g-4">

        <!-- AVATAR CARD -->
        <div class="col-12 col-lg-4">
            <div
                class="rounded-4 border bg-white p-4 text-center d-flex flex-column align-items-center justify-content-center">
                <form id="pictureForm" method="POST" action="{{ route('updateProfilePicture') }}"
                    enctype="multipart/form-data" class="needs-validation w-100" novalidate>
                    @csrf

                    <!-- Avatar preview -->
                    <div class="avatar-wrap mb-3">
                        @if ($user->profile_picture)
                            <img src="{{ asset('uploads/' . $user->profile_picture) }}" class="rounded-circle"
                                width="112" height="112" style="object-fit:cover;" id="avatarImg" />
                        @else
                            <img src="{{ asset('images/default.jpg') }}" class="rounded-circle" width="112"
                                height="112" style="object-fit:cover;" id="avatarImg" />
                        @endif
                    </div>

                    <p class="fw-semibold mb-0">{{ $user->name }}</p>
                    <p class="text-secondary small mb-3">{{ $user->email }}</p>

                    <!-- File input -->
                    <div class="mb-3 w-100">
                        <input type="file" class="form-control form-control-sm" id="avatarInput" name="profile"
                            accept="image/*" required />
                        <div class="invalid-feedback text-start">Please select a photo to upload.</div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold w-100">
                        Upload photo
                    </button>

                </form>
            </div>
        </div>

        <!-- COMBINED FORM CARD -->
        <div class="col-12 col-lg-8">
            <div class="rounded-4 border bg-white p-4">

                <form method="POST" action="{{ route('updateProfile') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">

                        <!-- PROFILE FIELDS -->
                        <div class="col-12 col-md-6">
                            <label for="fieldName" class="form-label small fw-medium">Full name</label>
                            <input type="text" id="fieldName" name="name" class="form-control form-control-sm py-2"
                                value="{{ $user->name }}" placeholder="James Macalintal" required />
                            <div class="invalid-feedback">Full name is required.</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="fieldEmail" class="form-label small fw-medium">Email</label>
                            <input type="email" id="fieldEmail" name="email" placeholder="james@gmail.com"
                                class="form-control form-control-sm py-2" value="{{ $user->email }}" required />
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="fieldPhone" class="form-label small fw-medium">Phone</label>
                            <input type="tel" id="fieldPhone" name="phone" placeholder="09123456789"
                                class="form-control form-control-sm py-2" value="{{ $user->phone }}" required />
                            <div class="invalid-feedback">Phone number is required.</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="fieldGender" class="form-label small fw-medium">Gender</label>
                            <select id="fieldGender" name="gender" class="form-select form-select-sm py-2" required>
                                <option value="" disabled {{ !$user->gender ? 'selected' : '' }}>Select gender
                                </option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <div class="invalid-feedback">Please select a gender.</div>
                        </div>

                        <div class="col-12">
                            <label for="fieldAddress" class="form-label small fw-medium">Address</label>
                            <input type="text" id="fieldAddress" name="address" placeholder="Quezon City, PH"
                                class="form-control form-control-sm py-2" value="{{ $user->address }}" required />
                            <div class="invalid-feedback">Address is required.</div>
                        </div>

                        <!-- DIVIDER -->
                        <div class="col-12">
                            <hr class="my-2" />
                        </div>

                        <!-- PASSWORD FIELDS -->
                        <div class="col-12">
                            <label for="currentPassword" class="form-label small fw-medium">Current password</label>
                            <div class="input-group input-group-sm has-validation">
                                <input type="password" id="currentPassword" minlength="6" name="current_password"
                                    class="form-control py-2" placeholder="••••••••" required/>
                                <button class="btn btn-light border toggle-pw" type="button"
                                    data-target="currentPassword">
                                    <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                                </button>
                                <div class="invalid-feedback">Password must be at least 6 characters.</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="newPassword" class="form-label small fw-medium">New password</label>
                            <div class="input-group input-group-sm has-validation">
                                <input type="password" id="newPassword" name="new_password" class="form-control py-2"
                                    placeholder="••••••••" minlength="6" required/>
                                <button class="btn btn-light border toggle-pw" type="button" data-target="newPassword">
                                    <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                                </button>
                                <div class="invalid-feedback">Password must be at least 6 characters.</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="confirmPassword" class="form-label small fw-medium">Confirm new password</label>
                            <div class="input-group input-group-sm has-validation">
                                <input type="password" id="confirmPassword" minlength="6" name="confirm_password"
                                    class="form-control py-2" placeholder="••••••••" required/>
                                <button class="btn btn-light border toggle-pw" type="button"
                                    data-target="confirmPassword">
                                    <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                                </button>
                                <div class="invalid-feedback">Password must be at least 6 characters.</div>
                            </div>
                        </div>

                        <!-- SAVE -->
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold">
                                Save changes
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/profile.js') }}"></script>
@endsection
