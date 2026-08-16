@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .admin-card-interactive {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .admin-card-interactive:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.08);
        border-color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    {{-- Hero Banner --}}
    <div class="rounded-3xl p-6 p-md-8 mb-6 text-white relative overflow-hidden border border-white/10 shadow-2xl" style="background: linear-gradient(135deg, #090d16 0%, #0f172a 60%, #1e293b 100%);">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 row align-items-center">
            <div class="col-lg-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-3 text-xs font-semibold tracking-wider uppercase text-rose-300 shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                    <span>Executive Administrator Console</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight mb-2">
                    System <span class="bg-gradient-to-r from-white via-slate-100 to-rose-200 bg-clip-text text-transparent">Administration</span>
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm font-normal max-w-xl leading-relaxed mb-0">
                    Real-time oversight across job vacancies, applicant submission activity, and corporate employer accounts.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="d-inline-flex flex-wrap gap-2">
                    <a href="{{ route('vacancy.create') }}" class="btn btn-danger rounded-pill px-3.5 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-plus-circle"></i>
                        <span>New Vacancy</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="btn btn-light rounded-pill px-3.5 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-file-earmark-bar-graph text-primary"></i>
                        <span>Reports</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Metric Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <!-- Total Jobs -->
        <div class="admin-card-interactive p-5 rounded-3xl flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-800 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest">Positions</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-slate-900 tracking-tight leading-none mb-1">{{ $totalJobs }}</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Total Vacancies</div>
                <a href="{{ route('vacancy.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-700 hover:text-slate-900 text-decoration-none">
                    <span>Manage Vacancies</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="admin-card-interactive p-5 rounded-3xl bg-gradient-to-br from-sky-50/40 to-white border-sky-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-file-earmark-person-fill"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-sky-500 uppercase tracking-widest">Applications</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-sky-600 tracking-tight leading-none mb-1">{{ $totalApplies }}</div>
                <div class="text-xs font-semibold text-sky-700/80 uppercase tracking-wider mb-3">Total Submissions</div>
                <a href="{{ route('apply.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sky-700 hover:text-sky-900 text-decoration-none">
                    <span>View Candidates</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Registered Users -->
        <div class="admin-card-interactive p-5 rounded-3xl bg-gradient-to-br from-purple-50/40 to-white border-purple-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-purple-500 uppercase tracking-widest">Accounts</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-purple-600 tracking-tight leading-none mb-1">{{ $totalUsers }}</div>
                <div class="text-xs font-semibold text-purple-700/80 uppercase tracking-wider mb-1">Total Users</div>
                <div class="text-[0.7rem] text-slate-500 mb-3">{{ $applicantsCount }} Jobseekers • {{ $employersCount }} Employers</div>
                <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-purple-700 hover:text-purple-900 text-decoration-none">
                    <span>Manage Users</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Registered Companies -->
        <div class="admin-card-interactive p-5 rounded-3xl bg-gradient-to-br from-emerald-50/40 to-white border-emerald-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-building"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-emerald-500 uppercase tracking-widest">Partners</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-emerald-600 tracking-tight leading-none mb-1">{{ $totalCompanies }}</div>
                <div class="text-xs font-semibold text-emerald-700/80 uppercase tracking-wider mb-3">Corporate Partners</div>
                <a href="{{ route('company.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 hover:text-emerald-900 text-decoration-none">
                    <span>Company Directory</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- Interactive Analytics Charts --}}
    <div class="row g-4 mb-6">
        <div class="col-lg-7">
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-b border-slate-100">
                    <div>
                        <h4 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight mb-0">Monthly Recruitment Activity</h4>
                        <p class="text-slate-500 text-xs mb-0">Job application submissions vs. active vacancies posted</p>
                    </div>
                    <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-2.5 py-1 text-xs">{{ date('Y') }}</span>
                </div>
                <div class="relative" style="height: 280px;">
                    <canvas id="recruitmentChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-b border-slate-100">
                    <div>
                        <h4 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight mb-0">User Growth</h4>
                        <p class="text-slate-500 text-xs mb-0">New candidate and employer registrations</p>
                    </div>
                    <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-2.5 py-1 text-xs">{{ date('Y') }}</span>
                </div>
                <div class="relative" style="height: 280px;">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Pipeline Records --}}
    <div class="row g-4">
        <!-- Recent Applications -->
        <div class="col-lg-6">
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-b border-slate-100">
                    <h5 class="text-base font-bold text-slate-900 tracking-tight mb-0">
                        <i class="bi bi-clock-history me-1.5 text-primary"></i> Latest Candidate Submissions
                    </h5>
                    <a href="{{ route('apply.index') }}" class="text-xs font-semibold text-rose-600 hover:text-rose-700 text-decoration-none">View All</a>
                </div>

                <div class="space-y-2.5">
                    @forelse($recentApplies as $item)
                        <div class="p-3 rounded-2xl border border-slate-100 bg-slate-50/60 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="font-bold text-slate-900 text-sm">
                                    {{ trim("{$item->first_name} {$item->last_name}") ?: 'Candidate' }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    Applied for <span class="font-semibold text-slate-700">{{ $item->title }}</span> • {{ $item->company_name }}
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-slate-200/80 text-slate-700 rounded-pill text-[0.65rem] px-2 py-0.5">{{ $item->remarks }}</span>
                                <div class="text-[0.65rem] text-slate-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-slate-400 text-xs">No application activity recorded yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Vacancies -->
        <div class="col-lg-6">
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-b border-slate-100">
                    <h5 class="text-base font-bold text-slate-900 tracking-tight mb-0">
                        <i class="bi bi-briefcase me-1.5 text-primary"></i> Recent Job Postings
                    </h5>
                    <a href="{{ route('vacancy.index') }}" class="text-xs font-semibold text-rose-600 hover:text-rose-700 text-decoration-none">View All</a>
                </div>

                <div class="space-y-2.5">
                    @forelse($recentVacancies as $vac)
                        <div class="p-3 rounded-2xl border border-slate-100 bg-slate-50/60 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="font-bold text-slate-900 text-sm">{{ $vac->title }}</div>
                                <div class="text-xs text-slate-500">
                                    <i class="bi bi-geo-alt me-1 text-slate-400"></i>{{ $vac->location }} • {{ $vac->company_name ?: 'Company' }}
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $vac->status == 1 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }} rounded-pill text-[0.65rem] px-2 py-0.5">
                                    {{ $vac->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                                <div class="text-[0.65rem] text-slate-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($vac->created_at)->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-slate-400 text-xs">No job vacancies created yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const months = @json($months);
        const monthlyUsers = @json($monthlyUsers);
        const monthlyApplies = @json($monthlyApplies);
        const monthlyVacancies = @json($monthlyVacancies);

        // Chart 1: Recruitment Activity Line Chart
        const ctx1 = document.getElementById('recruitmentChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Applications',
                        data: monthlyApplies,
                        borderColor: '#0284c7',
                        backgroundColor: 'rgba(2, 132, 199, 0.08)',
                        fill: true,
                        tension: 0.35,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#0284c7',
                    },
                    {
                        label: 'Vacancies Posted',
                        data: monthlyVacancies,
                        borderColor: '#e11d48',
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        tension: 0.35,
                        pointBackgroundColor: '#e11d48',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11 } } }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Chart 2: User Growth Bar Chart
        const ctx2 = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Registrations',
                    data: monthlyUsers,
                    backgroundColor: '#8b5cf6',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endpush
@endsection

