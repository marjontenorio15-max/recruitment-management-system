<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RMS | Recruitment Management System</title>

    <!-- Google Fonts & Bootstrap Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <style>
        :root {
            --ae-navy: #002855;
            --ae-navy-dark: #001a38;
            --ae-red: #e31837;
            --ae-red-hover: #c4122d;
            --ae-gray-bg: #f8fafc;
            --ae-border: #cbd5e1;
            --ae-text-dark: #0f172a;
            --ae-text-muted: #64748b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            color: var(--ae-text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .auth-content-area {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            background: radial-gradient(circle at 50% 0%, #e2eaf4 0%, #f8fafc 100%);
        }

        .auth-wrapper {
            width: 100%;
            max-width: 480px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid rgba(219, 226, 234, 0.9);
            box-shadow: 0 20px 40px -15px rgba(0, 40, 85, 0.1), 0 0 0 1px rgba(0, 40, 85, 0.02);
            overflow: hidden;
            position: relative;
        }

        .auth-card-accent {
            height: 4px;
            background: linear-gradient(90deg, #0f172a 0%, #e31837 100%);
        }

        .auth-card-body {
            padding: 2.5rem 2.25rem;
        }

        /* Custom Modern Inputs */
        .input-group-ae {
            border: 1.5px solid var(--ae-border);
            border-radius: 10px;
            background-color: #f8fafc;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }

        .input-group-ae:focus-within {
            border-color: var(--ae-navy);
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(0, 40, 85, 0.08);
        }

        .input-group-ae .input-group-text {
            background: transparent;
            border: none;
            color: var(--ae-text-muted);
            padding-left: 1rem;
        }

        .input-group-ae .form-control {
            border: none;
            background: transparent;
            padding: 0.85rem 1rem 0.85rem 0.5rem;
            font-size: 0.95rem;
            color: var(--ae-text-dark);
            box-shadow: none !important;
        }

        /* AE Branded Button */
        .btn-ae-primary {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
            transition: all 0.2s ease;
        }

        .btn-ae-primary:hover {
            background: #020617;
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.3);
            transform: translateY(-1px);
        }

        .btn-ae-primary:active {
            transform: translateY(0);
        }

        .auth-link {
            color: var(--ae-navy);
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .auth-link:hover {
            color: var(--ae-red);
            text-decoration: underline;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
</head>
<body>

    @include('layouts.partials.navbar')

    <main class="auth-content-area">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-card-accent"></div>
                <div class="auth-card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>
