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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Assets -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    @livewireStyles
    @stack('styles')

    <!-- Global Design Tokens & Utilities -->
    <style>
        :root {
            --ae-navy: #0f172a;
            --ae-navy-dark: #020617;
            --ae-red: #e31837;
            --ae-red-hover: #c4122d;
            --ae-blue-light: #f0f9ff;
            --ae-gray-bg: #f8fafc;
            --ae-border: #e2e8f0;
            --ae-text-dark: #0f172a;
            --ae-text-muted: #64748b;
            --ae-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --ae-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --ae-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            --ae-radius-md: 10px;
            --ae-radius-lg: 14px;
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
            letter-spacing: -0.011em;
        }

        main.app-content {
            flex: 1 0 auto;
            position: relative;
        }

        /* Modern Enterprise Dashboard Layout */
        .rms-dashboard-layout {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .rms-dashboard-sidebar {
            width: 270px;
            min-width: 270px;
            height: 100vh;
            position: sticky;
            top: 0;
            z-index: 1040;
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
        }

        .sidebar-link {
            color: #475569;
            font-size: 0.86rem;
            font-weight: 500;
            padding: 0.625rem 0.875rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.18s ease;
            text-decoration: none;
        }

        .sidebar-link:hover {
            color: #0f172a;
            background-color: #f1f5f9;
        }

        .sidebar-link.active {
            color: #0f172a;
            background-color: #e2e8f0;
            font-weight: 600;
        }

        .rms-dashboard-main {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background-color: var(--ae-gray-bg);
        }

        .user-avatar-badge {
            border-radius: 9999px;
            color: #ffffff;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 991.98px) {
            .rms-dashboard-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                transform: translateX(-100%);
                z-index: 1050;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
            }

            .rms-dashboard-sidebar.show {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background-color: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(2px);
                z-index: 1045;
            }

            .sidebar-backdrop.show {
                display: block;
            }
        }

        /* Modern Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--ae-gray-bg); }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Global Toast Styling Enhancements */
        .toast-container {
            z-index: 1090;
        }

        .toast-enterprise {
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.15), 0 8px 10px -6px rgba(15, 23, 42, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: var(--ae-radius-lg) !important;
            overflow: hidden;
        }

        /* Universal Text Selection */
        ::selection {
            background: rgba(227, 24, 55, 0.15);
            color: var(--ae-navy);
        }
    </style>
</head>
<body>

    @auth
        <!-- Authenticated Experience: Sidebar Navigation Layout -->
        <div class="rms-dashboard-layout">
            <!-- Sidebar Drawer Backdrop (Mobile) -->
            <div class="sidebar-backdrop d-lg-none" id="sidebarBackdrop"></div>

            <!-- Dashboard Sidebar -->
            @include('layouts.partials.sidebar')

            <!-- Main Dashboard Column -->
            <div class="rms-dashboard-main">
                @include('layouts.partials.dashboard-header')

                <main class="dashboard-content flex-grow-1 p-3 p-md-4">
                    @yield('content')
                </main>

                @include('layouts.footer')
            </div>
        </div>
    @else
        <!-- Guest Experience: Header Navbar Only (No Sidebar) -->
        @include('layouts.partials.navbars.guest-navbar')

        <main class="app-content py-4">
            @yield('content')
        </main>

        @include('layouts.footer')
    @endauth

    <!-- Global Toast Notification UI -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="rmsToast" class="toast toast-enterprise border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center p-3 text-white" id="rmsToastBg">
                <i class="bi me-2 fs-5" id="rmsToastIcon"></i>
                <div class="toast-body fw-medium small p-0 me-3" id="rmsToastBody"></div>
                <button type="button" class="btn-close btn-close-white ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
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
            bgEl.className = 'd-flex align-items-center p-3 text-white ' +
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

        // Sidebar Drawer Toggle for Mobile & Desktop
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');
            const sidebar = document.getElementById('rmsAppSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            function openSidebar() {
                if (sidebar) sidebar.classList.add('show');
                if (backdrop) backdrop.classList.add('show');
            }

            function closeSidebar() {
                if (sidebar) sidebar.classList.remove('show');
                if (backdrop) backdrop.classList.remove('show');
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    if (sidebar && sidebar.classList.contains('show')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
            }

            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);
        });
    </script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
