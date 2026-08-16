<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RMS | Recruitment Management System')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/Rms.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/Rms.png') }}">

    <!-- Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Assets -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    @livewireStyles
    @stack('styles')

    <!-- Global Design Tokens & Utilities -->
    <style>
        :root {
            --ae-navy: #002855;
            --ae-navy-dark: #001a38;
            --ae-red: #e31837;
            --ae-red-hover: #c4122d;
            --ae-blue-light: #e8f1f8;
            --ae-gray-bg: #f8fafc;
            --ae-border: #cbd5e1;
            --ae-text-dark: #1e293b;
            --ae-text-muted: #64748b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--ae-gray-bg);
            color: var(--ae-text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        main.app-content { flex: 1; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body>

    @include('layouts.partials.navbar')

    <main class="app-content py-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Global Toast Notification UI -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
        <div id="rmsToast" class="toast border-0 shadow-lg rounded-3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center p-2 rounded-3 text-white" id="rmsToastBg">
                <i class="bi me-2 fs-5" id="rmsToastIcon"></i>
                <div class="toast-body fw-medium small" id="rmsToastBody"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto shadow-none" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- JavaScript Assets -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Global jQuery Setup & Notification Helper -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Global Toast Launcher
        function showRmsToast(message, type = 'success') {
            const toastEl = document.getElementById('rmsToast');
            const bgEl = document.getElementById('rmsToastBg');
            const iconEl = document.getElementById('rmsToastIcon');
            const bodyEl = document.getElementById('rmsToastBody');

            bodyEl.innerText = message;
            bgEl.className = 'd-flex align-items-center p-2 rounded-3 text-white ' +
                (type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-primary');

            iconEl.className = 'bi me-2 fs-5 ' +
                (type === 'success' ? 'bi-check-circle-fill' : type === 'error' ? 'bi-exclamation-triangle-fill' : 'bi-info-circle-fill');

            const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
            toast.show();
        }

        // Global Search Debounce Handler
        let searchTimer;
        function debounceVacanciesSearch() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                if (typeof GetVacancies === 'function') {
                    GetVacancies();
                }
            }, 350);
        }
    </script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
