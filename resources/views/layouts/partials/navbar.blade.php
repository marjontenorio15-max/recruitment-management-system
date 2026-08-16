<!-- Global Dynamic Navigation Router -->
<style>
    .rms-navbar {
        background-color: #ffffff !important;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
    .rms-nav-link {
        font-weight: 500;
        font-size: 0.875rem;
        color: #475569 !important;
        padding: 0.5rem 0.85rem !important;
        border-radius: 9999px;
        transition: all 0.18s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .rms-nav-link:hover {
        color: #0f172a !important;
        background-color: #f1f5f9;
    }
    .rms-nav-link.active {
        color: #0f172a !important;
        font-weight: 600;
        background-color: #f1f5f9;
    }
    .user-avatar-badge {
        width: 26px;
        height: 26px;
        border-radius: 9999px;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>

@auth
    @if((int) auth()->user()->role_id === 1)
        @include('layouts.partials.navbars.admin-navbar')
    @elseif((int) auth()->user()->role_id === 2)
        @include('layouts.partials.navbars.employer-navbar')
    @elseif((int) auth()->user()->role_id === 3)
        @include('layouts.partials.navbars.applicant-navbar')
    @else
        @include('layouts.partials.navbars.guest-navbar')
    @endif
@else
    @include('layouts.partials.navbars.guest-navbar')
@endauth
