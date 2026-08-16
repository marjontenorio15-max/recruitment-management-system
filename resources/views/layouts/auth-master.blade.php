<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Advanced Energy RMS — Authentication</title>

    <!-- Google Fonts & Bootstrap Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --ae-navy: #002855;
            --ae-navy-dark: #001a38;
            --ae-red: #e31837;
            --ae-red-hover: #c4122d;
            --ae-gray-bg: #f0f4f8;
            --ae-border: #cbd5e1;
            --ae-text-dark: #0f172a;
            --ae-text-muted: #64748b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at 50% 0%, #e2eaf4 0%, #f0f4f8 100%);
            color: var(--ae-text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 2rem 1rem;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(219, 226, 234, 0.8);
            box-shadow: 0 20px 40px -15px rgba(0, 40, 85, 0.12), 0 0 0 1px rgba(0, 40, 85, 0.03);
            overflow: hidden;
            position: relative;
        }

        .auth-card-accent {
            height: 5px;
            background: linear-gradient(90deg, var(--ae-navy) 0%, var(--ae-red) 100%);
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
            box-shadow: 0 0 0 4px rgba(0, 40, 85, 0.1);
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
            background: linear-gradient(180deg, var(--ae-navy) 0%, var(--ae-navy-dark) 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 40, 85, 0.22);
            transition: all 0.2s ease;
        }

        .btn-ae-primary:hover {
            background: var(--ae-navy-dark);
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(0, 40, 85, 0.35);
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
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-card-accent"></div>
        <div class="auth-card-body">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
