<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Garahe — Vehicle records management</title>
    <meta name="description"
        content="Garahe is a vehicle records platform with an admin console and a client portal, built with Laravel." />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/landing/landing.css') }}" />
</head>

<body>
    @include('includes.toast')

    <!-- ── NAVBAR ── -->
    <nav class="navbar navbar-expand-md navbar-dark landing-nav fixed-top">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2 fw-bold">
                <span class="landing-logo-icon rounded-2"><i class="bi bi-car-front-fill text-white"></i></span>
                Garahe
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav mx-auto gap-md-2 small">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portals">Portals</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how">How it works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stack">Tech stack</a></li>
                </ul>
                <div class="d-flex gap-2 py-3 py-md-0">
                    @if (session('user'))
                        <a href="{{ session('user')->homeRoute() }}" class="btn btn-gold btn-sm rounded-3 px-3 fw-semibold">
                            Open {{ session('user')->isAdmin() ? 'dashboard' : 'my garage' }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-3 px-3">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-gold btn-sm rounded-3 px-3 fw-semibold">Get started</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- ── HERO ── -->
    <header class="landing-hero position-relative overflow-hidden text-white">
        <img src="{{ asset('images/hero-car.jpg') }}" alt=""
            class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover landing-hero-img" />
        <div class="landing-hero-gradient position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-12 col-lg-6">
                    <span class="landing-eyebrow rounded-pill mb-4">
                        <i class="bi bi-shield-check"></i> Vehicle records management
                    </span>
                    <h1 class="display-5 fw-bold lh-sm mb-3">Every record. Every plate. <span class="text-gold">One place.</span></h1>
                    <p class="lead text-white-50 mb-4 landing-lead">
                        Garahe keeps every vehicle organized: an admin console for the people who manage
                        the fleet, and a client portal for owners to track their own vehicles.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#demo" class="btn btn-gold rounded-3 px-4 py-2 fw-semibold">
                            <i class="bi bi-play-fill"></i> Try the live demo
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light rounded-3 px-4 py-2">Create an account</a>
                    </div>
                    <p class="small text-white-50 mt-3 mb-0">No sign up needed for the demo.</p>
                </div>

                <!-- APP PREVIEW (static mock of the dashboard) -->
                <div class="col-12 col-lg-6 d-none d-md-block">
                    <div class="landing-preview rounded-4 p-3">
                        <div class="d-flex gap-2 mb-3">
                            <span class="landing-dot"></span><span class="landing-dot"></span><span class="landing-dot"></span>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="bg-white text-dark rounded-3 p-3">
                                    <p class="text-secondary small mb-1">Vehicle Records</p>
                                    <p class="fw-bold fs-4 mb-0">128</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-white text-dark rounded-3 p-3">
                                    <p class="text-secondary small mb-1">Total Users</p>
                                    <p class="fw-bold fs-4 mb-0">24</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white text-dark rounded-3 p-3 mb-3">
                            <p class="small fw-semibold mb-2">Vehicles added per month</p>
                            <svg viewBox="0 0 300 70" class="w-100" preserveAspectRatio="none" aria-hidden="true">
                                <path d="M0 55 C30 50 45 30 75 35 S120 60 150 40 S200 10 225 22 S270 30 300 8 L300 70 L0 70 Z"
                                    fill="rgba(201,168,76,0.18)" />
                                <path d="M0 55 C30 50 45 30 75 35 S120 60 150 40 S200 10 225 22 S270 30 300 8"
                                    fill="none" stroke="#C9A84C" stroke-width="2.5" />
                            </svg>
                        </div>
                        <div class="bg-white text-dark rounded-3 p-3 small">
                            <div class="d-flex justify-content-between border-bottom pb-2 mb-2 text-secondary text-uppercase"
                                style="font-size:0.65rem;letter-spacing:0.05em;">
                                <span>Plate</span><span>Vehicle</span><span>Type</span>
                            </div>
                            <div class="d-flex justify-content-between py-1"><span class="fw-medium">NAB-4821</span><span class="text-secondary">Toyota Hilux</span><span>Truck</span></div>
                            <div class="d-flex justify-content-between py-1"><span class="fw-medium">DAE-1093</span><span class="text-secondary">Isuzu Traviz</span><span>Van</span></div>
                            <div class="d-flex justify-content-between py-1"><span class="fw-medium">PQR-7730</span><span class="text-secondary">Mitsubishi Montero</span><span>SUV</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ── FEATURES ── -->
    <section id="features" class="landing-section">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 560px;">
                <p class="landing-kicker mb-2">Features</p>
                <h2 class="fw-bold">Everything a vehicle registry needs</h2>
                <p class="text-secondary mb-0">From adding a plate number to seeing the whole fleet at a glance.</p>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['bi-file-earmark-spreadsheet', 'Vehicle records', 'Add, edit and delete vehicles with plate, brand, model, year and type. Duplicate plates are rejected.'],
                    ['bi-graph-up', 'Dashboard analytics', 'Monthly trends and a breakdown by vehicle type, drawn with Chart.js.'],
                    ['bi-shield-lock', 'Role-based access', 'Admins see every record and user. Clients only see the vehicles they own.'],
                    ['bi-people', 'User management', 'Admins can create accounts, assign roles and manage everyone in the workspace.'],
                    ['bi-search', 'Search & pagination', 'Every table can be searched, sorted and paged, so long lists stay manageable.'],
                    ['bi-person-badge', 'Profiles', 'Each user keeps their own details, password and profile photo up to date.'],
                ] as [$icon, $title, $text])
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="landing-card h-100 rounded-4 border bg-white p-4">
                            <span class="landing-feature-icon rounded-3 mb-3"><i class="bi {{ $icon }}"></i></span>
                            <h3 class="fs-6 fw-semibold mb-2">{{ $title }}</h3>
                            <p class="text-secondary small mb-0">{{ $text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── PORTALS / DEMO ── -->
    <section id="portals" class="landing-section bg-white border-top border-bottom">
        <div class="container">
            <div id="demo" class="text-center mx-auto mb-5" style="max-width: 560px;">
                <p class="landing-kicker mb-2">Two portals, one platform</p>
                <h2 class="fw-bold">Pick a side and look around</h2>
                <p class="text-secondary mb-0">
                    @if (config('demo.enabled'))
                        Each button signs you in to a shared demo account. Changes may be reset at any time.
                    @else
                        Log in or create an account to get started.
                    @endif
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- ADMIN -->
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="landing-portal landing-portal--dark h-100 rounded-4 p-4 p-lg-5 text-white d-flex flex-column">
                        <span class="landing-feature-icon rounded-3 mb-3"><i class="bi bi-speedometer2"></i></span>
                        <h3 class="fs-4 fw-bold mb-1">Admin console</h3>
                        <p class="text-white-50 small mb-4">For the office that manages the fleet.</p>
                        <ul class="list-unstyled small d-grid gap-2 mb-4">
                            <li><i class="bi bi-check2 text-gold me-2"></i>Fleet-wide dashboard and charts</li>
                            <li><i class="bi bi-check2 text-gold me-2"></i>Manage every vehicle and its owner</li>
                            <li><i class="bi bi-check2 text-gold me-2"></i>Create users and assign admin or client roles</li>
                        </ul>
                        <div class="mt-auto">
                            @if (config('demo.enabled'))
                                <form method="POST" action="{{ route('demoLogin', 'admin') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-gold w-100 rounded-3 py-2 fw-semibold">
                                        Explore as admin <i class="bi bi-arrow-right"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-gold w-100 rounded-3 py-2 fw-semibold">Log in</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- CLIENT -->
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="landing-portal h-100 rounded-4 border p-4 p-lg-5 d-flex flex-column">
                        <span class="landing-feature-icon rounded-3 mb-3"><i class="bi bi-house-door"></i></span>
                        <h3 class="fs-4 fw-bold mb-1">Client portal</h3>
                        <p class="text-secondary small mb-4">For owners keeping track of their own vehicles.</p>
                        <ul class="list-unstyled small d-grid gap-2 mb-4">
                            <li><i class="bi bi-check2 text-gold me-2"></i>A personal "My Garage" dashboard</li>
                            <li><i class="bi bi-check2 text-gold me-2"></i>Add and update the vehicles you own</li>
                            <li><i class="bi bi-check2 text-gold me-2"></i>Private: nobody else's records are visible</li>
                        </ul>
                        <div class="mt-auto">
                            @if (config('demo.enabled'))
                                <form method="POST" action="{{ route('demoLogin', 'client') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-dark w-100 rounded-3 py-2 fw-semibold">
                                        Explore as client <i class="bi bi-arrow-right"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-dark w-100 rounded-3 py-2 fw-semibold">Create an account</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── HOW IT WORKS ── -->
    <section id="how" class="landing-section">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 560px;">
                <p class="landing-kicker mb-2">How it works</p>
                <h2 class="fw-bold">Up and running in three steps</h2>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['Create an account', 'Sign up in under a minute. New accounts open in the client portal.'],
                    ['Add your vehicles', 'Log each vehicle with its plate, brand, model, year and type.'],
                    ['Track everything', 'Watch your records grow on the dashboard. Admins see the whole fleet.'],
                ] as $i => [$title, $text])
                    <div class="col-12 col-md-4">
                        <div class="d-flex gap-3">
                            <span class="landing-step rounded-circle flex-shrink-0">{{ $i + 1 }}</span>
                            <div>
                                <h3 class="fs-6 fw-semibold mb-1">{{ $title }}</h3>
                                <p class="text-secondary small mb-0">{{ $text }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── TECH STACK ── -->
    <section id="stack" class="landing-section pt-0">
        <div class="container">
            <div class="rounded-4 border bg-white p-4 p-lg-5 text-center">
                <p class="landing-kicker mb-2">Tech stack</p>
                <h2 class="fw-bold fs-4 mb-4">Built with</h2>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    @foreach (['Laravel 12', 'PHP 8', 'MySQL', 'Blade', 'Bootstrap 5', 'Chart.js', 'DataTables', 'jQuery', 'Vercel'] as $tech)
                        <span class="landing-chip rounded-pill">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section class="landing-section pt-0">
        <div class="container">
            <div class="landing-cta rounded-4 p-4 p-lg-5 text-white d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h2 class="fw-bold fs-3 mb-1">Bring order to your vehicle records.</h2>
                    <p class="text-white-50 mb-0">Free to try. Takes less than a minute.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('register') }}" class="btn btn-gold rounded-3 px-4 py-2 fw-semibold">Get started</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-3 px-4 py-2">Log in</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer class="py-4 border-top bg-white">
        <div class="container d-flex justify-content-center small text-secondary">
            <span class="d-flex align-items-center gap-2">
                <span class="landing-logo-icon landing-logo-icon--sm rounded-2"><i class="bi bi-car-front-fill text-white"></i></span>
                Garahe · Built by Lenard Colico as an ITEC 106 final project
            </span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/includes/toast.js') }}"></script>
</body>

</html>
