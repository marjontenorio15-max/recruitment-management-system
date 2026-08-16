@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        {{-- Header --}}
        <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                        <i class="bi bi-people-fill"></i>
                        <span>System Administration</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">User Directory</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Manage registered administrators, corporate employers, and jobseekers.</p>
                </div>

                {{-- Live Search Input --}}
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                        <i class="bi bi-search text-xs"></i>
                    </span>
                    <input type="text" id="searchAll" onkeyup="myFunctionSearch()" placeholder="Search username, email, role..." class="w-full pl-9 pr-4 py-2 rounded-pill text-xs bg-white text-slate-900 placeholder-slate-400 shadow-sm outline-none border-0">
                </div>
            </div>
        </div>

        {{-- Table Container --}}
        <div class="p-4 p-md-5">
            <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-4">
                <table class="table align-middle mb-0 text-sm" id="myTable">
                    <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="py-3 px-4">User</th>
                            <th class="py-3 px-4">Role</th>
                            <th class="py-3 px-4">Email Address</th>
                            <th class="py-3 px-4">Username</th>
                            <th class="py-3 px-4">Registered Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold text-xs d-flex align-items-center justify-content-center shadow-xs border border-slate-200">
                                            {{ strtoupper(substr($user->name ?? $user->username ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 text-sm">{{ $user->name ?? $user->username }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    @if($user->role_id == 1)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-xs font-semibold">
                                            <i class="bi bi-shield-lock-fill text-xs"></i> Administrator
                                        </span>
                                    @elseif($user->role_id == 2)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-xs font-semibold">
                                            <i class="bi bi-building text-xs"></i> Employer
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                                            <i class="bi bi-person text-xs"></i> Applicant
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-slate-600 text-xs">
                                    <i class="bi bi-envelope me-1 text-slate-400"></i>{{ $user->email }}
                                </td>
                                <td class="py-3 px-4 font-mono text-xs text-slate-700">
                                    {{ $user->username }}
                                </td>
                                <td class="py-3 px-4 text-xs text-slate-500">
                                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('M d, Y') : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">
                                    <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0 font-semibold text-slate-600">No users found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
    function myFunctionSearch() {
        var input = document.getElementById("searchAll");
        var filter = input.value.toUpperCase();
        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) {
            var rowText = tr[i].textContent || tr[i].innerText;
            if (rowText.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
@endpush
@endsection


