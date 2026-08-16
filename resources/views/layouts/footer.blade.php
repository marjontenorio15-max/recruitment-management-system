<!-- Custom CSS for Corporate RMS Footer Component -->
<style>
    .rms-footer {
        background-color: #ffffff;
        border-top: 1px solid var(--ae-border, #dbe2ea);
        font-size: 0.875rem;
    }

    .ae-footer-link {
        color: var(--ae-text-muted, #64748b) !important;
        font-weight: 500;
        transition: color 0.15s ease-in-out, text-decoration-color 0.15s ease-in-out;
    }

    .ae-footer-link:hover,
    .ae-footer-link:focus-visible {
        color: var(--ae-navy, #002855) !important;
        text-decoration: underline !important;
    }

    .ae-brand-badge {
        background-color: var(--ae-navy, #002855) !important;
        border-left: 3px solid var(--ae-red, #e31837);
        color: #ffffff;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 3px 7px;
        letter-spacing: 0.5px;
        border-radius: 3px;
    }
</style>

<footer class="rms-footer mt-auto py-4">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">

            <!-- Corporate Brand & Copyright -->
            <div class="d-flex align-items-center gap-2 flex-wrap justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center gap-1">
                    <span class="ae-brand-badge">AE</span>
                    <span class="fw-bold fs-6 tracking-tight ms-1" style="color: var(--ae-navy, #002855) !important;">RMS</span>
                </div>
                <span class="text-muted d-none d-sm-inline">|</span>
                <span class="text-muted small">&copy; {{ date('Y') }} RMS. All rights reserved.</span>
            </div>

            <!-- Footer Navigation Links -->
            <nav aria-label="Footer Navigation">
                <ul class="list-inline mb-0 small">
                    <li class="list-inline-item me-3 me-lg-4">
                        <a href="{{ route('front-page') }}" class="ae-footer-link text-decoration-none">Home</a>
                    </li>
                    <li class="list-inline-item me-3 me-lg-4">
                        <a href="{{ route('about') }}" class="ae-footer-link text-decoration-none">About Us</a>
                    </li>
                    <li class="list-inline-item me-3 me-lg-4">
                        <a href="{{ route('term') }}" class="ae-footer-link text-decoration-none">Terms &amp; Conditions</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('contacts') }}" class="ae-footer-link text-decoration-none">Contact Us</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</footer>
