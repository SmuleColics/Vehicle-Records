@extends('layouts.auth')

@section('title', 'Login')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}" />
@endsection

@section('content')
    <div class="container-fluid min-vh-100 p-0 d-flex">

        <!-- LEFT PANEL — Form -->
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center px-4 py-5 bg-white">
            <div class="auth-form-wrap w-100">

                <!-- Back to landing page -->
                <div class="mb-4">
                    <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-1 small text-secondary text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Back to home
                    </a>
                </div>

                <!-- Logo -->
                <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none text-dark fw-bold mb-5">
                    <span class="auth-logo-icon rounded-2">
                        <i class="bi bi-car-front-fill text-white"></i>
                    </span>
                    <span class="fs-4">Garahe</span>
                </a>

                <h1 class="fw-bold fs-3 mb-1">Welcome back</h1>
                <p class="text-secondary small mb-4">Log in to manage your vehicle records.</p>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-medium">Email</label>
                        <input type="email" id="email" class="form-control form-control-sm py-2"
                            placeholder="james@gmail.com" name="email" required />
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label small fw-medium mb-0">Password</label>
                            <a href="#" class="small text-secondary text-decoration-none login-forgot">Forgot?</a>
                        </div>
                        <div class="input-group input-group-sm has-validation">
                            <input type="password" id="password" class="form-control py-2" placeholder="••••••••"
                                name="password" required />
                            <button class="btn btn-light border" type="button" id="togglePassword">
                                <i class="bi bi-eye" style="font-size:0.8rem;"></i>
                            </button>
                            <div class="invalid-feedback">Password is required.</div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold small">
                        Log in
                    </button>

                </form>

                @if (config('demo.enabled'))
                    <div class="auth-demo rounded-3 border p-3 mt-4">
                        <p class="small fw-semibold mb-1">Just visiting?</p>
                        <p class="small text-secondary mb-2">Look around with a demo account, no password needed.</p>
                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('demoLogin', 'admin') }}" class="flex-fill">
                                @csrf
                                <button type="submit" class="btn btn-light border btn-sm w-100">
                                    <i class="bi bi-speedometer2"></i> Admin demo
                                </button>
                            </form>
                            <form method="POST" action="{{ route('demoLogin', 'client') }}" class="flex-fill">
                                @csrf
                                <button type="submit" class="btn btn-light border btn-sm w-100">
                                    <i class="bi bi-house-door"></i> Client demo
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <p class="text-center text-secondary small mt-4 mb-0">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="fw-semibold text-dark text-decoration-none login-create">Create
                        one</a>
                </p>

            </div>
        </div>

        <!-- RIGHT PANEL — Visual -->
        <div class="login-right d-none d-md-flex col-md-6 position-relative overflow-hidden">
            <img src="{{ asset('images/hero-car.jpg') }}" alt=""
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover opacity-60" />
            <div class="login-right-gradient position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="position-relative z-2 d-flex flex-column justify-content-end p-5 text-white h-100">
                <p class="small text-white-50 mb-2">"Every record. Every plate. One place."</p>
                <p class="fs-4 fw-bold lh-sm mw-340">The records platform built for the road.</p>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/auth/auth.js') }}"></script>
@endsection
