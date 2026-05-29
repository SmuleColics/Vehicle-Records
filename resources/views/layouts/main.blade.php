<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Garahe — @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('css/includes/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" />
    @yield('styles')
</head>

<body>
    @include('includes.toast')

    <div class="admin-layout">
        @include('includes.sidebar')
        <div class="admin-main d-flex flex-column">
            @include('includes.topbar')
            <main class="admin-content flex-grow-1 p-4 p-md-5">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- jQuery FIRST -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <!-- Bootstrap JS AFTER jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS AFTER jQuery -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @yield('scripts')
    <script src="{{ asset('js/includes/toast.js') }}"></script>
</body>

</html>