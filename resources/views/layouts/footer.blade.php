<footer class="bg-white border-top mt-auto py-4">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">

            <!-- Corporate Brand & Copyright -->
            <div class="d-flex align-items-center gap-2 flex-wrap justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center gap-1">
                    <span class="px-2 py-1 bg-dark text-white fw-bold rounded-1 extra-small" style="background-color: #002855 !important; border-left: 3px solid #e31837; letter-spacing: 0.5px;">AE</span>
                    <span class="fw-bold text-dark fs-6 ms-1">RMS</span>
                </div>
                <span class="text-muted small">&copy; {{ date('Y') }} AEI General Services, Inc. All rights reserved.</span>
            </div>

            <!-- Footer Navigation Links -->
            <nav aria-label="Footer Navigation">
                <ul class="list-inline mb-0 small">
                    <li class="list-inline-item me-3">
                        <a href="{{ route('front-page') }}" class="text-secondary text-decoration-none ae-footer-link">Home</a>
                    </li>
                    <li class="list-inline-item me-3">
                        <a href="{{ route('about') }}" class="text-secondary text-decoration-none ae-footer-link">About Us</a>
                    </li>
                    <li class="list-inline-item me-3">
                        <a href="{{ route('term') }}" class="text-secondary text-decoration-none ae-footer-link">Terms &amp; Conditions</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('contacts') }}" class="text-secondary text-decoration-none ae-footer-link">Contact Us</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</footer>
