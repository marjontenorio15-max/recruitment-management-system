
@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-6 max-w-2xl mx-auto">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        {{-- Header --}}
        <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                <i class="bi bi-cloud-arrow-up-fill"></i>
                <span>Document Storage</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">File Attachment</h2>
            <p class="text-slate-300 text-xs sm:text-sm mb-0">Upload documents or resume files to your storage repository.</p>
        </div>

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-2xl border-0 p-3 mb-4 bg-emerald-50 text-emerald-800" role="alert">
                    <i class="bi bi-check-circle-fill me-1 text-emerald-600"></i>
                    <span class="text-xs font-medium">{{ session('success') }}</span>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('save-file') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="myfile" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Select File <span class="text-rose-500">*</span></label>
                    <input type="file" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" name="myfile" id="myfile" required>
                    <p class="text-slate-400 text-xs mt-1">Accepted formats: PDF, DOC, DOCX, PNG, JPG (Max: 10MB)</p>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-2">
                    <a href="{{ url()->previous() }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-upload me-1"></i> Upload File
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

