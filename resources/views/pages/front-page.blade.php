@php
    use Illuminate\Support\Facades\DB;

    // Fallback query if $counts isn't provided directly by the controller
if (!isset($counts) && auth()->check() && auth()->user()->role_id == 3) {
    $counts = DB::table('apply')
        ->where('applicant_id', auth()->id())
        ->selectRaw(
            "
                COUNT(*) as total,
                COUNT(CASE WHEN remarks = 'Pending' THEN 1 END) as pending,
                COUNT(CASE WHEN remarks = 'Hired' THEN 1 END) as hired,
                COUNT(CASE WHEN remarks = 'For Interview' THEN 1 END) as interview,
                COUNT(CASE WHEN remarks = 'Reject' THEN 1 END) as reject
                ",
            )
            ->first();
    }
@endphp

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
        /* Front Page Custom Micro-Interactions & Animations */
        .hero-mesh-gradient {
            background: radial-gradient(at 0% 0%, rgba(227, 24, 55, 0.2) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                linear-gradient(135deg, #090d16 0%, #0f172a 60%, #1e293b 100%);
        }

        .glass-card-interactive {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card-interactive:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.1);
        }

        .status-dot-pulse {
            animation: pulseDot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulseDot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.15);
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

        {{-- Hero Section for Visitors & Applicants --}}
        <div
            class="hero-mesh-gradient rounded-3xl p-6 p-md-10 mb-6 text-white relative overflow-hidden border border-white/10 shadow-2xl transition-all duration-300">
            {{-- Soft background orb highlights --}}
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 row align-items-center">
                <div class="col-lg-8">
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-4 text-xs font-semibold tracking-wider uppercase text-rose-300 shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-rose-400 status-dot-pulse"></span>
                        <span>Career & Talent Portal</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-3">
                        Discover Your Next <span
                            class="bg-gradient-to-r from-white via-slate-100 to-rose-200 bg-clip-text text-transparent">Career
                            Opportunity</span>
                    </h1>

                    <p class="text-slate-300 text-sm sm:text-base font-normal max-w-xl leading-relaxed mb-4">
                        Explore verified openings, apply directly in seconds, and track your active application milestones
                        in real-time.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        <a href="#view"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-medium text-sm transition-all duration-200 shadow-lg shadow-rose-600/30 hover:shadow-rose-600/50 hover:scale-105 active:scale-95 text-decoration-none">
                            <span>Browse Openings</span>
                            <i class="bi bi-arrow-down-short text-lg"></i>
                        </a>
                        @guest
                            <a href="{{ route('register.show') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-medium text-sm backdrop-blur-sm border border-white/20 transition-all duration-200 text-decoration-none hover:border-white/40">
                                <span>Create Account</span>
                                <i class="bi bi-person-plus"></i>
                            </a>
                        @endguest
                    </div>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                    <div class="relative flex justify-center items-center">
                        <div
                            class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md text-center max-w-xs shadow-xl">
                            <div
                                class="w-14 h-14 mx-auto rounded-xl bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center text-white text-2xl mb-3 shadow-lg shadow-rose-500/30">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <h6 class="text-white font-semibold mb-1">Direct Applications</h6>
                            <p class="text-slate-400 text-xs mb-0">Fast-track recruitment pipeline with verified company
                                employers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Applicant Tracker Dashboard Widget --}}
        @auth
            @if (auth()->user()->role_id == 3)
                <div class="mb-8">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Application Tracker</h4>
                            </div>
                            <p class="text-slate-500 text-xs sm:text-sm mb-0 mt-0.5">Live status summary of your submitted job
                                applications</p>
                        </div>
                        <a href="{{ route('applicant-dashboard') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-all shadow-sm hover:shadow hover:border-slate-300 text-decoration-none self-start sm:self-auto">
                            <span>View Full Dashboard</span>
                            <i class="bi bi-arrow-right text-slate-400 group-hover:text-slate-700"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">

                        <!-- Total Applied -->
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none group">
                            <div
                                class="glass-card-interactive p-4 rounded-2xl border border-slate-200/80 flex flex-col justify-between h-full group-hover:border-slate-400/80">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-lg transition-transform group-hover:scale-110 shadow-xs">
                                        <i class="bi bi-folder-check"></i>
                                    </div>
                                    <span class="text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest">Total</span>
                                </div>
                                <div>
                                    <div
                                        class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-none mb-1">
                                        {{ $counts->total ?? 0 }}</div>
                                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Applied
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Under Review -->
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none group">
                            <div
                                class="glass-card-interactive p-4 rounded-2xl border border-amber-200/80 bg-gradient-to-br from-amber-50/40 to-white flex flex-col justify-between h-full group-hover:border-amber-400/80">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg transition-transform group-hover:scale-110 shadow-xs">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>
                                    <span
                                        class="text-[0.65rem] font-bold text-amber-500 uppercase tracking-widest">Review</span>
                                </div>
                                <div>
                                    <div
                                        class="text-2xl sm:text-3xl font-extrabold text-amber-600 tracking-tight leading-none mb-1">
                                        {{ $counts->pending ?? 0 }}</div>
                                    <div class="text-xs font-semibold text-amber-700/80 uppercase tracking-wider">Under Review
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Interviews -->
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none group">
                            <div
                                class="glass-card-interactive p-4 rounded-2xl border border-sky-200/80 bg-gradient-to-br from-sky-50/40 to-white flex flex-col justify-between h-full group-hover:border-sky-400/80">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-lg transition-transform group-hover:scale-110 shadow-xs">
                                        <i class="bi bi-calendar2-event"></i>
                                    </div>
                                    <span
                                        class="text-[0.65rem] font-bold text-sky-500 uppercase tracking-widest">Schedule</span>
                                </div>
                                <div>
                                    <div
                                        class="text-2xl sm:text-3xl font-extrabold text-sky-600 tracking-tight leading-none mb-1">
                                        {{ $counts->interview ?? 0 }}</div>
                                    <div class="text-xs font-semibold text-sky-700/80 uppercase tracking-wider">Interviews</div>
                                </div>
                            </div>
                        </a>

                        <!-- Hired -->
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none group">
                            <div
                                class="glass-card-interactive p-4 rounded-2xl border border-emerald-200/80 bg-gradient-to-br from-emerald-50/40 to-white flex flex-col justify-between h-full group-hover:border-emerald-400/80">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg transition-transform group-hover:scale-110 shadow-xs">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <span
                                        class="text-[0.65rem] font-bold text-emerald-500 uppercase tracking-widest">Success</span>
                                </div>
                                <div>
                                    <div
                                        class="text-2xl sm:text-3xl font-extrabold text-emerald-600 tracking-tight leading-none mb-1">
                                        {{ $counts->hired ?? 0 }}</div>
                                    <div class="text-xs font-semibold text-emerald-700/80 uppercase tracking-wider">Hired</div>
                                </div>
                            </div>
                        </a>

                        <!-- Unsuccessful -->
                        <a href="{{ route('applicant-dashboard') }}"
                            class="text-decoration-none col-span-2 md:col-span-1 group">
                            <div
                                class="glass-card-interactive p-4 rounded-2xl border border-rose-200/80 bg-gradient-to-br from-rose-50/40 to-white flex flex-col justify-between h-full group-hover:border-rose-400/80">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-lg transition-transform group-hover:scale-110 shadow-xs">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <span class="text-[0.65rem] font-bold text-rose-500 uppercase tracking-widest">Closed</span>
                                </div>
                                <div>
                                    <div
                                        class="text-2xl sm:text-3xl font-extrabold text-rose-600 tracking-tight leading-none mb-1">
                                        {{ $counts->reject ?? 0 }}</div>
                                    <div class="text-xs font-semibold text-rose-700/80 uppercase tracking-wider">Unsuccessful
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            @endif
        @endauth

        {{-- Job Openings Section --}}
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6 mb-6">
            <div
                class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 pb-4 mb-4 border-b border-slate-100">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <h4 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight mb-0">Open Positions</h4>
                    </div>
                    <p class="text-slate-500 text-xs sm:text-sm mb-0 mt-0.5">Browse and search through all verified
                        vacancies</p>
                </div>
                <div
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold self-start sm:self-auto">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 status-dot-pulse"></span>
                    <span>Active Openings</span>
                </div>
            </div>

            {{-- Public Job List Blade Include --}}
            @include('jobs.public-list')
        </div>

    </div>
@endsection
