@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-4xl mx-auto">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        {{-- Header --}}
        <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                        <i class="bi bi-building-add"></i>
                        <span>Company Registration</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Add New Company</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Create an employer account and register company credentials.</p>
                </div>
                <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 self-start sm:self-auto" href="{{ route('company.index') }}">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Directory</span>
                </a>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-0 border-0 m-0 p-4 bg-rose-50 text-rose-800" role="alert">
                <div class="font-bold text-sm mb-1 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-octagon-fill text-rose-600"></i>
                    <span>Please correct the errors below:</span>
                </div>
                <ul class="mb-0 text-xs list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            <form action="{{ route('company.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Company Name <span class="text-rose-500">*</span></label>
                        <input type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="company_name" value="{{ old('company_name') }}" placeholder="e.g. Acme Corporation" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Contact Number <span class="text-rose-500">*</span></label>
                        <input type="number" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="contact_no" value="{{ old('contact_no') }}" placeholder="e.g. 09123456789" required>
                    </div>

                    <div class="col-12">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Corporate Office Address <span class="text-rose-500">*</span></label>
                        <input type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="address" value="{{ old('address') }}" placeholder="Street, City, Province" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address <span class="text-rose-500">*</span></label>
                        <input type="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="email" value="{{ old('email') }}" placeholder="company@example.com" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Login Username <span class="text-rose-500">*</span></label>
                        <input type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="username" value="{{ old('username') }}" placeholder="username" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password <span class="text-rose-500">*</span></label>
                        <input type="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Confirm Password <span class="text-rose-500">*</span></label>
                        <input type="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-3">
                    <a href="{{ route('company.index') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-check2 me-1"></i> Save Company
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>
@endsection

