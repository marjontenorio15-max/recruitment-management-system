<!-- Custom UI Enhancements for RMS Job Search -->
<style>
    .extra-small { font-size: 0.725rem; }
    .tracking-tight { letter-spacing: -0.025em; }
    .tracking-wide { letter-spacing: 0.05em; }

    .job-scroll-container::-webkit-scrollbar { width: 5px; }
    .job-scroll-container::-webkit-scrollbar-track { background: #f1f5f9; }
    .job-scroll-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .job-scroll-container::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    .search-filter-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
    }

    .search-input-group {
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    .search-input-group:focus-within {
        background-color: #ffffff;
        border-color: #0f172a;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }

    .job-item-card {
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
        border: 1px solid #e2e8f0;
        position: relative;
    }

    .job-item-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 6px 16px -4px rgba(15, 23, 42, 0.08) !important;
        transform: translateY(-2px);
    }

    .job-item-card.active {
        background-color: #ffffff !important;
        border-color: #0f172a !important;
        box-shadow: 0 8px 20px -4px rgba(15, 23, 42, 0.1) !important;
    }

    .job-item-card.active::before {
        content: '';
        position: absolute;
        left: -1px;
        top: -1px;
        bottom: -1px;
        width: 4px;
        background-color: #e31837;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .detail-header-panel {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .metric-highlight-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        transition: border-color 0.2s ease;
    }

    .metric-highlight-box:hover {
        border-color: #cbd5e1;
    }
</style>

<div class="job-search-wrapper py-2" id="view">
    <div class="container-xl px-0">

        <!-- Search Bar Container -->
        <div class="card search-filter-card rounded-4 mb-4">
            <div class="card-body p-3 p-md-4">
                <form id="vacancySearchForm" novalidate autocomplete="off" onsubmit="return false;">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-md-4">
                            <label for="myInputJobTitle" class="form-label extra-small fw-bold text-uppercase text-muted mb-1 px-1 tracking-wide">
                                <i class="bi bi-search me-1 text-primary"></i> Job Title / Keyword
                            </label>
                            <div class="input-group search-input-group rounded-3 overflow-hidden">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-briefcase"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputJobTitle" placeholder="e.g. Software Engineer, PHP..." type="text">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="myInputCompany" class="form-label extra-small fw-bold text-uppercase text-muted mb-1 px-1 tracking-wide">
                                <i class="bi bi-building me-1 text-primary"></i> Company / Division
                            </label>
                            <div class="input-group search-input-group rounded-3 overflow-hidden">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-buildings"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputCompany" placeholder="Company or department..." type="text">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="myInputCity" class="form-label extra-small fw-bold text-uppercase text-muted mb-1 px-1 tracking-wide">
                                <i class="bi bi-geo-alt me-1 text-primary"></i> Location
                            </label>
                            <div class="input-group search-input-group rounded-3 overflow-hidden">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-pin-map"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputCity" placeholder="City, region, or remote..." type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Notifications -->
        @if(session()->has('message'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-3 p-3" role="alert">
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
                    <span class="fw-bold text-dark fs-6 tracking-tight">Available Openings</span>
                    <span class="badge bg-slate-100 text-dark border rounded-pill px-2.5 py-1 extra-small fw-semibold shadow-2xs d-inline-flex align-items-center gap-1">
                        <i class="bi bi-record-fill text-success small"></i> Live Updates
                    </span>
                </div>

                <div class="divJobList job-scroll-container d-flex flex-column gap-2.5" style="max-height: 740px; overflow-y: auto;">
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
                    <div class="detail-header-panel p-4 text-white position-relative">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-start gap-3 position-relative" style="z-index: 1;">
                            <div>
                                <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 rounded-pill px-3 py-1 extra-small fw-bold text-uppercase mb-2 tracking-wide">
                                    <i class="bi bi-eye me-1"></i> Job Preview
                                </span>
                                <h2 class="h4 fw-bold text-white mb-1 spanTitle tracking-tight">Select a Position</h2>
                                <p class="mb-0 text-white-50 small">Click any job posting on the left to view complete details.</p>
                            </div>
                            <div class="text-sm-end text-white-50 extra-small flex-shrink-0 bg-white bg-opacity-10 p-2.5 rounded-3 border border-white border-opacity-10">
                                <span class="d-block text-uppercase extra-small tracking-wide opacity-75">Posted</span>
                                <span class="fw-bold text-white fs-6 spanDatePosted">--</span>
                            </div>
                        </div>
                    </div>

                    <!-- Highlight Grid -->
                    <div class="p-3 p-md-4 border-bottom bg-slate-50">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="metric-highlight-box p-3 text-center">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1 tracking-wide">Compensation</span>
                                    <span class="fw-bold text-dark fs-6 spanSalary">--</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="metric-highlight-box p-3 text-center">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1 tracking-wide">Location</span>
                                    <span class="fw-bold text-dark fs-6 spanLocation">--</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="metric-highlight-box p-3 text-center">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1 tracking-wide">Openings</span>
                                    <span class="fw-bold text-dark fs-6 spanNoOfEmp">--</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Body -->
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12 col-md-7">
                                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2 d-flex align-items-center gap-2">
                                    <i class="bi bi-file-text text-primary"></i> Description & Responsibilities
                                </h6>
                                <p class="text-secondary small lh-relaxed spanJobDesc">
                                    No job selected. Select a vacancy card to inspect requirements, location, salary range, and qualification criteria.
                                </p>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="border rounded-3 p-3 bg-slate-50">
                                    <h6 class="fw-bold text-dark mb-3 extra-small text-uppercase tracking-wide d-flex align-items-center gap-2">
                                        <i class="bi bi-sliders text-primary"></i> Overview Specs
                                    </h6>
                                    <div class="d-flex flex-column gap-2 small">
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
                            <div class="card-footer bg-white border-top p-3.5 d-flex justify-content-between align-items-center cardFooter d-none">
                                <span class="text-muted small fw-medium">Ready to step into this role?</span>
                                <button type="button" class="btn btn-danger btn-lg rounded-pill px-4 fs-6 fw-semibold shadow-sm btnApply d-inline-flex align-items-center gap-2">
                                    <span>Apply Now</span>
                                    <i class="bi bi-arrow-right"></i>
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
    let searchDebounceTimer = null;
    let globalJobList = [];

    $(document).ready(function() {
        GetVacancies();

        $('.search-input').on('keyup input', function() {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(function() {
                GetVacancies();
            }, 300);
        });

        $(document).on('click', '.btnApply', function () {
            const jobId = $('#txtApplyJobId').val();
            if (!jobId) {
                if (typeof showRmsToast === 'function') {
                    showRmsToast('Please select a job first.', 'error');
                } else {
                    alert('Please select a job first.');
                }
                return;
            }

            const btn = $(this);
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Submitting...');

            $.ajax({
                url: "{{ url('/applyJob') }}",
                type: "GET",
                data: {
                    job_id: jobId,
                    remarks: 'Pending'
                },
                success: function (data) {
                    btn.prop('disabled', false).html('<span>Apply Now</span> <i class="bi bi-arrow-right"></i>');
                    if (data.result === 1) {
                        if (typeof showRmsToast === 'function') {
                            showRmsToast('Application submitted successfully!', 'success');
                        } else {
                            alert('Successfully Applied!');
                        }
                    } else if (data.result === 2) {
                        if (typeof showRmsToast === 'function') {
                            showRmsToast('You have already applied for this job!', 'info');
                        } else {
                            alert('You have already applied on this job!');
                        }
                    } else {
                        if (typeof showRmsToast === 'function') {
                            showRmsToast('Application failed. Please try again.', 'error');
                        } else {
                            alert('Application Failed!');
                        }
                    }
                },
                error: function () {
                    btn.prop('disabled', false).html('<span>Apply Now</span> <i class="bi bi-arrow-right"></i>');
                    if (typeof showRmsToast === 'function') {
                        showRmsToast('Network error while submitting application.', 'error');
                    } else {
                        alert('Application Failed due to network error.');
                    }
                }
            });
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
            url: "{{ route('vacancies.active') }}",
            type: "GET",
            data: {
                title: title,
                created_by: company,
                location: city
            },
            dataType: "json",
            success: function(response) {
                let rawJobs = [];
                if (response && Array.isArray(response.vacancies)) {
                    rawJobs = response.vacancies;
                } else if (Array.isArray(response)) {
                    rawJobs = response;
                } else if (response && Array.isArray(response.data)) {
                    rawJobs = response.data;
                }

                globalJobList = rawJobs;
                let html = '';

                if (rawJobs.length > 0) {
                    $.each(rawJobs, function(index, job) {
                        const jobTitle = job.title || 'Untitled Position';
                        const companyName = job.company_name || job.created_by || 'Company';
                        const location = job.location || 'N/A';
                        const salary = job.salary ? '₱' + Number(job.salary).toLocaleString() : 'Negotiable';

                        html += `
                            <div class="card job-item-card p-3 rounded-3 bg-white" onclick="selectJobByIndex(${index}, this)">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 70%;">${jobTitle}</h6>
                                    <span class="badge bg-slate-100 text-dark border extra-small rounded-pill px-2.5 py-1 text-truncate" style="max-width: 28%;">${companyName}</span>
                                </div>
                                <div class="d-flex flex-wrap gap-3 text-muted extra-small">
                                    <span class="d-inline-flex align-items-center gap-1"><i class="bi bi-geo-alt text-slate-400"></i>${location}</span>
                                    <span class="d-inline-flex align-items-center gap-1"><i class="bi bi-cash-stack text-slate-400"></i>${salary}</span>
                                </div>
                            </div>
                        `;
                    });

                    $('.divJobList').html(html);
                    selectJobByIndex(0, $('.job-item-card').first());
                } else {
                    html = `
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white">
                            <i class="bi bi-search text-muted fs-1 mb-2 opacity-50"></i>
                            <h6 class="fw-bold text-dark mb-1">No vacancies found</h6>
                            <p class="text-muted extra-small mb-3">Try adjusting your title, company, or location terms.</p>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 mx-auto extra-small fw-semibold" onclick="clearFilters()">Reset Filters</button>
                        </div>
                    `;
                    $('.divJobList').html(html);
                    resetJobPreview();
                }
            },
            error: function(xhr, status, error) {
                console.error("RMS Job Fetch Error:", error);
                $('.divJobList').html(`
                    <div class="alert alert-danger extra-small rounded-3 mb-0 border-0 shadow-sm">
                        Failed to fetch openings. Please verify your connection or controller route.
                    </div>
                `);
                resetJobPreview();
            }
        });
    }

    function selectJobByIndex(index, element) {
        const job = globalJobList[index];
        if (!job) return;

        $('.job-item-card').removeClass('active');
        if (element) {
            $(element).addClass('active');
        }

        const title = job.title || 'Position Details';
        const salary = job.salary ? '₱' + Number(job.salary).toLocaleString() : 'Negotiable';
        const location = job.location || 'N/A';
        const vacancies = job.no_of_employee || '1';
        const posted = job.created_at ? new Date(job.created_at).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' }) : 'Recently';
        const description = job.job_desc || 'No detailed description available.';
        const degree = job.degree || 'N/A';
        const sex = job.sex || 'Any';
        const qualification = job.work_exp || 'N/A';
        const id = job.id || '';

        $('.spanTitle').text(title);
        $('.spanSalary').text(salary);
        $('.spanLocation').text(location);
        $('.spanNoOfEmp').text(vacancies);
        $('.spanDatePosted').text(posted);
        $('.spanJobDesc').html(description);
        $('.spanDegree').text(degree);
        $('.spanSex').text(sex);
        $('.spanQualification').text(qualification);
        $('#txtApplyJobId').val(id);

        $('.cardFooter').removeClass('d-none');
    }

    function resetJobPreview() {
        $('.spanTitle').text('Select a Position');
        $('.spanSalary').text('--');
        $('.spanLocation').text('--');
        $('.spanNoOfEmp').text('--');
        $('.spanDatePosted').text('--');
        $('.spanJobDesc').html('No job selected. Select a vacancy card to inspect requirements, location, salary range, and qualification criteria.');
        $('.spanDegree').text('--');
        $('.spanSex').text('--');
        $('.spanQualification').text('--');
        $('#txtApplyJobId').val('');
        $('.cardFooter').addClass('d-none');
    }

    function clearFilters() {
        $('#vacancySearchForm')[0].reset();
        GetVacancies();
    }
</script>
@endpush
