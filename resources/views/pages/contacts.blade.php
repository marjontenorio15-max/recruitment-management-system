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
    .contact-hero-mesh {
        background: radial-gradient(at 0% 0%, rgba(227, 24, 55, 0.2) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                    linear-gradient(135deg, #090d16 0%, #0f172a 60%, #1e293b 100%);
    }

    .contact-card-interactive {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .contact-card-interactive:hover {
        border-color: #cbd5e1;
        box-shadow: 0 12px 28px -6px rgba(15, 23, 42, 0.08);
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    {{-- Hero Banner --}}
    <div class="contact-hero-mesh rounded-3xl p-6 p-md-10 mb-8 text-white relative overflow-hidden border border-white/10 shadow-2xl">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 row align-items-center">
            <div class="col-lg-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-4 text-xs font-semibold tracking-wider uppercase text-rose-300 shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                    <span>Get In Touch</span>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-3">
                    We'd Love to <span class="bg-gradient-to-r from-white via-slate-100 to-rose-200 bg-clip-text text-transparent">Hear From You</span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base font-normal max-w-xl leading-relaxed mb-0">
                    Have questions regarding vacancies, employer partnership, or applicant support? Send us a message and our team will get back to you promptly.
                </p>
            </div>

            <div class="col-lg-4 d-none d-lg-block text-end">
                <div class="inline-flex flex-col gap-2 bg-white/5 border border-white/10 p-5 rounded-2xl backdrop-blur-md text-left max-w-xs">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-10 h-10 rounded-xl bg-rose-500/20 border border-rose-500/30 flex items-center justify-center text-rose-400">
                            <i class="bi bi-geo-alt-fill text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-300 uppercase">Main Office</div>
                            <div class="text-xs text-white-50">Cabuyao, Laguna</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Notification Alerts --}}
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show rounded-2xl border-0 shadow-sm p-4 mb-6 d-flex align-items-center gap-3 bg-emerald-50 text-emerald-800" role="alert">
            <i class="bi bi-check-circle-fill fs-4 text-emerald-600"></i>
            <div class="fw-medium">{{ session('message') }}</div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-2xl border-0 shadow-sm p-4 mb-6 bg-rose-50 text-rose-800" role="alert">
            <div class="d-flex align-items-center gap-2 mb-2 font-bold text-sm">
                <i class="bi bi-exclamation-octagon-fill text-rose-600 fs-5"></i>
                <span>Please fix the following issues:</span>
            </div>
            <ul class="mb-0 text-xs list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 align-items-start mb-8">
        {{-- Contact Form Column --}}
        <div class="col-lg-7">
            <div class="contact-card-interactive p-6 sm:p-8 rounded-3xl">
                <div class="mb-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-rose-600 d-block mb-1">Direct Inquiry</span>
                    <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Send Us a Message</h3>
                    <p class="text-slate-500 text-sm mt-1">Fill out the form below and we will respond via email within 24 hours.</p>
                </div>

                <form method="POST" action="{{ route('contact.mailContactForm') }}" class="space-y-4">
                    {{ csrf_field() }}

                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Full Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 transition-all outline-none" id="name" placeholder="John Doe" name="name" required>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 transition-all outline-none" id="email" placeholder="john@example.com" name="email" required>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Your Message <span class="text-rose-500">*</span>
                        </label>
                        <textarea rows="5" class="w-full p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 transition-all outline-none" id="message" placeholder="How can we assist you today?" name="message" required></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                            <i class="bi bi-send-fill text-xs"></i>
                            <span>Send Message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Contact Info & Map Sidebar --}}
        <div class="col-lg-5 space-y-4">
            <div class="contact-card-interactive p-6 rounded-3xl">
                <h5 class="font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="bi bi-building text-rose-600"></i>
                    <span>Contact Information</span>
                </h5>

                <ul class="space-y-4 text-sm text-slate-600 mb-6">
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 d-block text-xs uppercase tracking-wide">Office Address</span>
                            <span>149 JP Rizal St, Cabuyao, 4025 Laguna, Philippines</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 d-block text-xs uppercase tracking-wide">Phone</span>
                            <a href="tel:0495312610" class="text-slate-700 hover:text-slate-900 text-decoration-none">(049) 531 2610</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 d-block text-xs uppercase tracking-wide">Office Hours</span>
                            <span>Monday – Friday: 8:00 AM – 5:00 PM</span>
                        </div>
                    </li>
                </ul>

                <h6 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-2">Get Directions</h6>
                <form action="https://maps.google.com/maps" method="get" target="_blank" class="flex gap-2">
                    <input type="text" name="saddr" placeholder="Enter your starting location" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 bg-slate-50 focus:bg-white focus:border-slate-900 outline-none">
                    <input type="hidden" name="daddr" value="149 JP Rizal St, Cabuyao, 4025 Laguna">
                    <button type="submit" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
            </div>

            {{-- Interactive Google Map --}}
            <div class="contact-card-interactive rounded-3xl overflow-hidden p-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3866.750331842739!2d121.12489671420299!3d14.267777388972618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d887b96bbf75%3A0x6827238058a0cd!2sAlimagno%20Enterprises%2C%20Inc.!5e0!3m2!1sen!2sph!4v1666698087865!5m2!1sen!2sph" class="w-full rounded-2xl" height="240" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

</div>
@endsection

