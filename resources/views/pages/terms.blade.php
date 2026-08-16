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
    .terms-hero-mesh {
        background: radial-gradient(at 0% 0%, rgba(227, 24, 55, 0.2) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                    linear-gradient(135deg, #090d16 0%, #0f172a 60%, #1e293b 100%);
    }

    .terms-card-interactive {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .terms-card-interactive:hover {
        border-color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-5xl mx-auto">

    {{-- Hero Banner --}}
    <div class="terms-hero-mesh rounded-3xl p-6 p-md-10 mb-8 text-white relative overflow-hidden border border-white/10 shadow-2xl">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-4 text-xs font-semibold tracking-wider uppercase text-rose-300 shadow-inner">
                <i class="bi bi-file-earmark-text-fill text-rose-400"></i>
                <span>Platform Governance & Policy</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-3">
                Terms and <span class="bg-gradient-to-r from-white via-slate-100 to-rose-200 bg-clip-text text-transparent">Conditions</span>
            </h1>

            <p class="text-slate-300 text-sm sm:text-base font-normal max-w-2xl leading-relaxed mb-0">
                Please review the guidelines governing your access, applicant registration, data usage, and employer interactions on the AEI Recruitment Management System.
            </p>
        </div>
    </div>

    {{-- Terms Document Container --}}
    <div class="space-y-6 mb-10">

        {{-- Section 1: Registration & Account --}}
        <div class="terms-card-interactive p-6 sm:p-8 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg">
                    1
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-rose-600 d-block">User Eligibility</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-0">Registration & Account Accuracy</h3>
                </div>
            </div>
            <div class="prose prose-slate text-sm sm:text-base text-slate-600 leading-relaxed">
                <p>
                    To use the Site, you must first register or create an account, where you will be asked to provide your personal and sensitive personal information, such as your name, contact information, professional, educational, and personal background. You must provide true and correct information. False information will result in the suspension or termination of your Account.
                </p>
                <p class="mb-0">
                    The platform shall be entitled to refuse any and all current or future use of the service. You agree to the use and disclosure of the information you provide in the registration and creation of your Account, which information will be used solely for the purpose of AEI providing the recruitment service described in these Terms and shall be subject to these Terms.
                </p>
            </div>
        </div>

        {{-- Section 2: Website & Service Venue --}}
        <div class="terms-card-interactive p-6 sm:p-8 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-lg">
                    2
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600 d-block">Platform Role</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-0">The Website and Recruitment Service</h3>
                </div>
            </div>
            <div class="prose prose-slate text-sm sm:text-base text-slate-600 leading-relaxed">
                <p>
                    Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern the relationship between you and RMS in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.
                </p>
                <p class="mb-0">
                    The Website connects employers and job seekers through an online job posting service. AEI Recruitment Management System provides a dedicated venue for job seekers to find potential employers, and for employers to locate suitable applicants based on posted requirements. Both job seekers and employers must conduct their own due diligence.
                </p>
            </div>
        </div>

        {{-- Section 3: Obligations of Applicants & Employers --}}
        <div class="terms-card-interactive p-6 sm:p-8 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg">
                    3
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 d-block">Compliance</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-0">Obligations & Representations</h3>
                </div>
            </div>
            <div class="prose prose-slate text-sm sm:text-base text-slate-600 leading-relaxed">
                <p>
                    If you are a job applicant, you represent that you are at least eighteen (18) years old and legally permitted to work in the Philippines; if you are an employer, you represent that you are duly authorized to represent the company, that the company you represent is lawfully organized and existing under Philippine laws, and that the job postings offered are in accordance with Philippine labor laws.
                </p>
                <p class="mb-0">
                    You also agree to use any applicant's data only for the limited purpose of evaluating the applicant for possible engagement, and you agree to delete any unnecessary applicant data as soon as possible and to be held liable for any unlawful distribution of such data without the related applicant's consent.
                </p>
            </div>
        </div>

        {{-- Section 4: Electronic Communications & Third Parties --}}
        <div class="terms-card-interactive p-6 sm:p-8 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-lg">
                    4
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600 d-block">Communications & Links</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-0">Electronic Notices & External Links</h3>
                </div>
            </div>
            <div class="prose prose-slate text-sm sm:text-base text-slate-600 leading-relaxed">
                <p>
                    You are communicating with the platform electronically when you visit the Site, provide content, or send e-mails. You agree to receive communications electronically via email or notices posted on the Site, satisfying any legal requirement that such communications be in writing.
                </p>
                <p class="mb-0">
                    The Site may contain links to third-party websites or services that are not owned or controlled by AEI. We do not endorse or assume responsibility for any third-party websites, materials, products, or services. Accessing third-party resources is conducted at your own risk.
                </p>
            </div>
        </div>

    </div>

    {{-- Bottom Action Helper --}}
    <div class="text-center py-4">
        <a href="{{ route('front-page') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all shadow-sm text-decoration-none">
            <i class="bi bi-arrow-left"></i>
            <span>Return to Home</span>
        </a>
    </div>

</div>
@endsection

