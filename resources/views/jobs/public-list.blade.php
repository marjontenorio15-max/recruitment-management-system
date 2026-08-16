<!-- Custom UI Enhancements for RMS Job Search -->
<style>
    .extra-small { font-size: 0.75rem; }
    .tracking-tight { letter-spacing: -0.025em; }
    .hero-banner-rms {
        background: linear-gradient(135deg, #002855 0%, #004080 100%);
        border-bottom: 4px solid #e31837;
    }
    .job-scroll-container::-webkit-scrollbar { width: 5px; }
    .job-scroll-container::-webkit-scrollbar-track { background: #f1f5f9; }
    .job-scroll-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .job-item-card {
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        border: 1px solid #e2e8f0;
    }
    .job-item-card:hover, .job-item-card.active {
        border-color: #002855 !important;
        box-shadow: 0 4px 14px rgba(0, 40, 85, 0.08) !important;
        transform: translateY(-2px);
    }
    .job-item-card.active {
        background-color: #f8fafc;
        border-left: 4px solid #e31837 !important;
    }
</style>

<div class="job-search-wrapper bg-light min-vh-100 py-4" id="view">
    <div class="container-xl">

        <!-- Search Bar Container -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <form id="vacancySearchForm" novalidate autocomplete="off" onsubmit="return false;">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-md-4">
                            <label for="myInputJobTitle" class="form-label extra-small fw-bold text-uppercase text-muted mb-1 px-1">Job Title / Keyword</label>
                            <div class="input-group input-group-lg border rounded-3 overflow-hidden bg-light focus-ring">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-search"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputJobTitle" placeholder="e.g. Software Engineer, PHP..." type="text" onkeyup="GetVacancies()">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="myInputCompany" class="form-label extra-small fw-bold text-uppercase text-muted mb-1 px-1">Company / Division</label>
                            <div class="input-group input-group-lg border rounded-3 overflow-hidden bg-light focus-ring">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-building"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputCompany" placeholder="Company or department..." type="text" onkeyup="GetVacancies()">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="myInputCity" class="form-label extra-small fw-bold text-uppercase text-muted mb-1 px-1">Location</label>
                            <div class="input-group input-group-lg border rounded-3 overflow-hidden bg-light focus-ring">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-geo-alt"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputCity" placeholder="City, region, or remote..." type="text" onkeyup="GetVacancies()">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Notifications -->
        @if(session()->has('message'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger flex-shrink-0"></i>
                <div class="fw-medium small">{{ session('message') }}</div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Split Workspace -->
        <div class="row g-4 align-items-start">

            <!-- Left Column: Openings List -->
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                    <span class="fw-bold text-dark fs-6">Available Openings</span>
                    <span class="badge bg-white text-secondary border rounded-pill px-2.5 py-1 extra-small fw-normal shadow-sm">
                        <i class="bi bi-broadcast text-success me-1"></i> Live Updates
                    </span>
                </div>

                <div class="divJobList job-scroll-container d-flex flex-column gap-2" style="max-height: 720px; overflow-y: auto;">
                    <!-- Loading Placeholder -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 text-center bg-white">
                        <div class="spinner-border spinner-border-sm text-primary mx-auto mb-2" role="status"></div>
                        <span class="text-muted small">Fetching vacancies...</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sticky Detail Panel -->
            <div class="col-12 col-lg-7 col-xl-8 sticky-top" style="top: 90px; z-index: 10;">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden cardJobDetails bg-white">

                    <!-- Header -->
                    <div class="bg-dark bg-gradient p-4 text-white position-relative">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-start gap-3">
                            <div>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 extra-small fw-bold text-uppercase mb-2">
                                    Job Preview
                                </span>
                                <h2 class="h3 fw-bold text-white mb-1 spanTitle">Select a Position</h2>
                                <p class="mb-0 text-white-50 small">Click any job posting on the left to view complete details.</p>
                            </div>
                            <div class="text-sm-end text-white-50 extra-small flex-shrink-0">
                                Posted <br>
                                <span class="fw-bold text-white fs-6 spanDatePosted">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- Highlight Grid -->
                    <div class="p-4 border-bottom bg-light bg-opacity-50">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="bg-white p-3 rounded-3 border text-center shadow-2xs">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1">Compensation</span>
                                    <span class="fw-bold text-dark fs-6 spanSalary">--</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-white p-3 rounded-3 border text-center shadow-2xs">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1">Location</span>
                                    <span class="fw-bold text-dark fs-6 spanLocation">--</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-white p-3 rounded-3 border text-center shadow-2xs">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1">Openings</span>
                                    <span class="fw-bold text-dark fs-6 spanNoOfEmp">--</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Body -->
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12 col-md-7">
                                <h6 class="fw-bold text-dark mb-2 border-bottom pb-2">Description & Responsibilities</h6>
                                <p class="text-secondary small lh-relaxed spanJobDesc">
                                    No job selected. Select a vacancy card to inspect requirements, location, salary range, and qualification criteria.
                                </p>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="fw-bold text-dark mb-3 extra-small text-uppercase tracking-wider">Overview</h6>
                                    <div class="d-flex flex-column gap-2.5 small">
                                        <div class="d-flex justify-content-between pb-2 border-bottom">
                                            <span class="text-muted">Degree Required</span>
                                            <span class="fw-semibold text-dark spanDegree">--</span>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2 border-bottom">
                                            <span class="text-muted">Sex Preference</span>
                                            <span class="fw-semibold text-dark spanSex">--</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Work Experience</span>
                                            <span class="fw-semibold text-dark spanQualification">--</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="job_id" id="txtApplyJobId">
                    </div>

                    <!-- Footer Action -->
                    @auth
                        @if(auth()->user()->role_id == 3)
                            <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center cardFooter d-none">
                                <span class="text-muted small">Ready to step into this role?</span>
                                <button type="button" class="btn btn-primary btn-lg rounded-pill px-4 fs-6 fw-bold shadow-sm btnApply">
                                    Apply Now <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        // Trigger initial fetch on load
        GetVacancies();

        // Attach debounced keyup listener to search inputs
        $('.search-input').on('keyup input', function() {
            debounceVacanciesSearch();
        });
    });

    function GetVacancies() {
        const title = $('#myInputJobTitle').val();
        const company = $('#myInputCompany').val();
        const city = $('#myInputCity').val();

        $('.divJobList').html(`
            <div class="card border-0 shadow-sm rounded-3 p-4 text-center bg-white">
                <div class="spinner-border spinner-border-sm text-primary mx-auto mb-2" role="status"></div>
                <span class="text-muted small">Searching vacancies...</span>
            </div>
        `);

        $.ajax({
            url: "{{ route('view-jobs') }}", // Adjust route to match your search endpoint
            type: "GET",
            data: { title: title, company: company, city: city },
            dataType: "json",
            success: function(response) {
                let html = '';

                if (response.data && response.data.length > 0) {
                    $.each(response.data, function(index, job) {
                        html += `
                            <div class="card job-item-card p-3 rounded-3 bg-white" onclick="selectJobDetail(this, ${JSON.stringify(job).replace(/"/g, '&quot;')})">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 80%;">${job.title}</h6>
                                    <span class="badge bg-light text-primary border extra-small">${job.company_name || 'AE Corp'}</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2 text-muted extra-small mb-2">
                                    <span><i class="bi bi-geo-alt me-1"></i>${job.location || 'N/A'}</span>
                                    <span><i class="bi bi-cash-stack me-1"></i>${job.salary || 'Negotiable'}</span>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    html = `
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white">
                            <i class="bi bi-search text-muted fs-1 mb-2"></i>
                            <h6 class="fw-bold text-dark mb-1">No vacancies found</h6>
                            <p class="text-muted extra-small mb-3">Try adjusting your title, company, or location terms.</p>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 mx-auto extra-small" onclick="clearFilters()">Reset Filters</button>
                        </div>
                    `;
                }

                $('.divJobList').html(html);
            },
            error: function() {
                $('.divJobList').html(`
                    <div class="alert alert-danger extra-small rounded-3 mb-0">
                        Failed to fetch openings. Please try again.
                    </div>
                `);
            }
        });
    }

    function selectJobDetail(element, job) {
        $('.job-item-card').removeClass('active');
        $(element).addClass('active');

        $('.spanTitle').text(job.title);
        $('.spanSalary').text(job.salary || 'Negotiable');
        $('.spanLocation').text(job.location || 'N/A');
        $('.spanNoOfEmp').text(job.vacancies_count || '1');
        $('.spanDatePosted').text(job.created_at || 'Recently');
        $('.spanJobDesc').text(job.description || 'No detailed description available.');
        $('#txtApplyJobId').val(job.id);

        $('.cardFooter').removeClass('d-none');
    }

    function clearFilters() {
        $('#vacancySearchForm')[0].reset();
        GetVacancies();
        showRmsToast('Search filters cleared.', 'info');
    }
</script>
@endpush
