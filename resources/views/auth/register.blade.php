@extends('layouts.auth')

@section('title', 'Register')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}" />
@endsection

@section('content')
    <div class="container-fluid min-vh-100 p-0 d-flex">

        <!-- LEFT PANEL -->
        <div class="register-left d-none d-md-flex col-md-6 position-relative overflow-hidden">
            <img src="{{ asset('images/hero-car.jpg') }}" alt=""
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover opacity-60" />
            <div class="register-left-gradient position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="position-relative z-2 d-flex flex-column justify-content-end p-5 text-white h-100">
                <p class="small text-white-50 mb-2">Get started in under a minute.</p>
                <p class="fs-4 fw-bold lh-sm" style="max-width: 340px">Bring order to your vehicle records.</p>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center px-4 py-5 bg-white">
            <div class="auth-form-wrap w-100">

                <!-- Logo -->
                <a href="/"
                    class="d-inline-flex align-items-center gap-2 text-decoration-none text-dark fw-bold mb-5">
                    <span class="auth-logo-icon rounded-2">
                        <i class="bi bi-car-front-fill text-white"></i>
                    </span>
                    <span class="fs-4">Garahe</span>
                </a>

                <h1 class="fw-bold fs-3 mb-1">Create your account</h1>
                <p class="text-secondary small mb-4">Flood control vehicle records.</p>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf
                    <!-- Full name -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label small fw-medium">Full name</label>
                        <input type="text" id="fullName" class="form-control form-control-sm py-2"
                            placeholder="James Macalintal" name="name" required />
                        <div class="invalid-feedback">Full name is required.</div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-medium">Email</label>
                        <input type="email" id="email" class="form-control form-control-sm py-2"
                            placeholder="james@gmail.com" name="email" required />
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-medium">Password</label>
                        <div class="input-group input-group-sm">
                            <input type="password" id="password" class="form-control py-2"
                                placeholder="At least 6 characters" minlength="6" name="password" required />
                            <button class="btn btn-light border" type="button" id="togglePassword">
                                <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Password must be at least 6 characters.</div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label small fw-medium">Confirm password</label>
                        <div class="input-group input-group-sm">
                            <input type="password" id="confirm_password" name="confirm_password"
                                class="form-control py-2" placeholder="Confirm password" required />
                            <button class="btn btn-light border" type="button" id="togglePasswordConfirm">
                                <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Passwords do not match.</div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold small">
                        Create account
                    </button>

                </form>

                <p class="text-center text-secondary small mt-4 mb-0">
                    Already have an account?
                    <a href="{{ route('login') }}" class="fw-semibold text-dark text-decoration-none">Log in</a>
                </p>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/auth/auth.js') }}"></script>
@endsection
