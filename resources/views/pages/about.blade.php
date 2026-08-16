@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    rmsNavy: {
                        900: '#0a0f1d',
                        800: '#0f172a',
                        700: '#1e293b',
                    },
                    rmsRed: {
                        DEFAULT: '#e31837',
                        hover: '#c4122d',
                        light: '#fff1f2',
                    }
                }
            }
        }
    }
</script>
<style>
    .about-hero-mesh {
        background: radial-gradient(at 0% 0%, rgba(227, 24, 55, 0.2) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                    linear-gradient(135deg, #090d16 0%, #0f172a 60%, #1e293b 100%);
    }

    .about-card-interactive {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .about-card-interactive:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.08);
        border-color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    {{-- Hero Section --}}
    <div class="about-hero-mesh rounded-3xl p-6 p-md-10 mb-8 text-white relative overflow-hidden border border-white/10 shadow-2xl">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 row align-items-center">
            <div class="col-lg-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-4 text-xs font-semibold tracking-wider uppercase text-rose-300 shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                    <span>About AEI Recruitment Management</span>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-3">
                    Connecting Ambition with <span class="bg-gradient-to-r from-white via-slate-100 to-rose-200 bg-clip-text text-transparent">Opportunity</span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base font-normal max-w-xl leading-relaxed mb-4">
                    We bridge the gap between motivated talent and top industry employers through a streamlined, transparent, and data-driven recruitment platform.
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <a href="{{ route('view-jobs') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-medium text-sm transition-all duration-200 shadow-lg shadow-rose-600/30 hover:shadow-rose-600/50 hover:scale-105 active:scale-95 text-decoration-none">
                        <span>Explore Openings</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ route('contacts') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-medium text-sm backdrop-blur-sm border border-white/20 transition-all duration-200 text-decoration-none hover:border-white/40">
                        <span>Contact Our Team</span>
                        <i class="bi bi-chat-dots"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 d-none d-lg-block">
                <div class="relative flex justify-center items-center">
                    <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md text-center max-w-xs shadow-xl">
                        <div class="w-14 h-14 mx-auto rounded-xl bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center text-white text-2xl mb-3 shadow-lg shadow-rose-500/30">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h6 class="text-white font-semibold mb-1">Verified Placements</h6>
                        <p class="text-slate-400 text-xs mb-0">Partnering with legitimate enterprises for authentic career opportunities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mission & Values Section --}}
    <div class="mb-10">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-bold uppercase tracking-widest text-rose-600 d-block mb-1">Our Core Values</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">Built For Jobseekers & Employers Alike</h2>
            <p class="text-slate-500 text-sm mt-2">Designed from the ground up to reduce hiring friction, eliminate paper bottlenecks, and deliver clear progress at every step.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            {{-- Card 1 --}}
            <div class="about-card-interactive p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl mb-4 shadow-sm border border-rose-100">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h5 class="font-bold text-slate-900 text-lg mb-2">Smart Matching</h5>
                    <p class="text-slate-500 text-sm leading-relaxed mb-0">
                        Intelligent qualification filtering aligns applicant degrees and work history with job prerequisites for better hiring outcomes.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 text-xs font-semibold text-rose-600 uppercase tracking-wider">
                    Precision Placement
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="about-card-interactive p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl mb-4 shadow-sm border border-sky-100">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h5 class="font-bold text-slate-900 text-lg mb-2">Real-Time Transparency</h5>
                    <p class="text-slate-500 text-sm leading-relaxed mb-0">
                        Track application statuses live from submission to interview scheduling and final hiring remarks without guessing.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 text-xs font-semibold text-sky-600 uppercase tracking-wider">
                    Instant Status Tracking
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="about-card-interactive p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mb-4 shadow-sm border border-emerald-100">
                        <i class="bi bi-building-check"></i>
                    </div>
                    <h5 class="font-bold text-slate-900 text-lg mb-2">Verified Companies</h5>
                    <p class="text-slate-500 text-sm leading-relaxed mb-0">
                        Direct relationships with registered companies provide authentic vacancies, safe career paths, and verified employer communication.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 text-xs font-semibold text-emerald-600 uppercase tracking-wider">
                    Direct Corporate Access
                </div>
            </div>
        </div>
    </div>

    {{-- Trusted Companies / Partners Showcase --}}
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-8 mb-8">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 pb-4 mb-6 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight mb-0">Partner Organizations</h3>
                </div>
                <p class="text-slate-500 text-xs sm:text-sm mb-0 mt-0.5">Top industry employers actively recruiting through our platform</p>
            </div>
            <a href="{{ route('view-jobs') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-slate-200 bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-xs transition-all text-decoration-none self-start sm:self-auto">
                <span>Browse Partner Openings</span>
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Partner 1: Nestle --}}
            <div class="about-card-interactive p-5 rounded-2xl flex flex-col justify-between text-center group">
                <div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-lg mb-3 group-hover:scale-105 transition-transform">
                        <i class="bi bi-cup-hot-fill text-2xl text-amber-700"></i>
                    </div>
                    <h6 class="font-bold text-slate-900 mb-1">Nestlé Philippines</h6>
                    <p class="text-slate-500 text-xs mb-3">Consumer Goods & Nutrition</p>
                    <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-2.5 py-1 text-xs">Mitchell Young • CEO</span>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="https://www.nestle.com/jobs/search-jobs" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-700 text-decoration-none">
                        <span>Careers Site</span>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </div>

            {{-- Partner 2: Del Monte --}}
            <div class="about-card-interactive p-5 rounded-2xl flex flex-col justify-between text-center group">
                <div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-lg mb-3 group-hover:scale-105 transition-transform">
                        <i class="bi bi-flower1 text-2xl text-emerald-600"></i>
                    </div>
                    <h6 class="font-bold text-slate-900 mb-1">Del Monte Fresh</h6>
                    <p class="text-slate-500 text-xs mb-3">Food & Agriculture</p>
                    <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-2.5 py-1 text-xs">Ronald Green • Strategy</span>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="{{ route('view-jobs') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-700 text-decoration-none">
                        <span>View Vacancies</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Partner 3: Wyeth --}}
            <div class="about-card-interactive p-5 rounded-2xl flex flex-col justify-between text-center group">
                <div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-lg mb-3 group-hover:scale-105 transition-transform">
                        <i class="bi bi-capsule text-2xl text-sky-600"></i>
                    </div>
                    <h6 class="font-bold text-slate-900 mb-1">Wyeth Nutrition</h6>
                    <p class="text-slate-500 text-xs mb-3">Healthcare & Pharmaceuticals</p>
                    <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-2.5 py-1 text-xs">Carl Peppard • GM</span>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="{{ route('view-jobs') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-700 text-decoration-none">
                        <span>View Vacancies</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Partner 4: Goldilocks --}}
            <div class="about-card-interactive p-5 rounded-2xl flex flex-col justify-between text-center group">
                <div>
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-lg mb-3 group-hover:scale-105 transition-transform">
                        <i class="bi bi-cake2-fill text-2xl text-amber-500"></i>
                    </div>
                    <h6 class="font-bold text-slate-900 mb-1">Goldilocks Bakeshop</h6>
                    <p class="text-slate-500 text-xs mb-3">Food & Hospitality</p>
                    <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-2.5 py-1 text-xs">Sandra Bullock • Support</span>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <a href="{{ route('view-jobs') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-700 text-decoration-none">
                        <span>View Vacancies</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom CTA Banner --}}
    <div class="about-hero-mesh rounded-3xl p-6 p-md-8 text-white relative overflow-hidden text-center">
        <div class="relative z-10 max-w-xl mx-auto">
            <h3 class="text-2xl font-bold text-white mb-2">Ready to Take the Next Step in Your Career?</h3>
            <p class="text-slate-300 text-sm mb-4">Create your profile today or explore all verified job vacancies open right now.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('view-jobs') }}" class="btn btn-danger rounded-pill px-4 py-2 font-semibold shadow-sm">
                    Find Vacancies
                </a>
                @guest
                    <a href="{{ route('register.show') }}" class="btn btn-outline-light rounded-pill px-4 py-2 font-semibold">
                        Sign Up
                    </a>
                @endguest
            </div>
        </div>
    </div>

</div>
@endsection

