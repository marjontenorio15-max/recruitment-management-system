<div class="job-search-wrapper bg-light min-vh-100 py-4" id="view">
    <div class="container-xl">

        <!-- Hero Header -->
        <div class="hero-banner bg-dark text-white rounded-4 p-4 p-md-5 mb-4 position-relative overflow-hidden shadow-sm">
            <div class="position-relative z-1 max-w-2xl">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold mb-3">
                    <i class="bi bi-briefcase-fill me-1"></i> RMS Career Portal
                </span>
                <h1 class="display-6 fw-bold tracking-tight text-white mb-2">Find your next opportunity.</h1>
                <p class="text-secondary fs-6 mb-0">Discover open positions, connect with top hiring companies, and fast-track your application.</p>
            </div>
        </div>

        <!-- Integrated Search Bar Container -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <form id="vacancySearchForm" novalidate autocomplete="off" onsubmit="return false;">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-lg border rounded-3 overflow-hidden bg-light">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-search"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputJobTitle" placeholder="Job title, keywords..." type="text">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-lg border rounded-3 overflow-hidden bg-light">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-building"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputCompany" placeholder="Company name..." type="text">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-lg border rounded-3 overflow-hidden bg-light">
                                <span class="input-group-text bg-transparent border-0 text-muted ps-3"><i class="bi bi-geo-alt"></i></span>
                                <input class="form-control bg-transparent border-0 fs-6 shadow-none search-input" id="myInputCity" placeholder="City, region, or remote..." type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Notifications -->
        @if(session()->has('message'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
                <div class="fw-medium">{{ session('message') }}</div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Split Workspace -->
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                    <span class="fw-bold text-dark fs-6">Available Openings</span>
                    <span class="badge bg-white text-secondary border rounded-pill px-2 py-1 small fw-normal">Live Updates</span>
                </div>

                <div class="divJobList d-flex flex-column gap-2" style="max-height: 720px; overflow-y: auto; scrollbar-width: thin;">
                    <div class="card border-0 shadow-sm rounded-3 p-4 text-center">
                        <div class="spinner-border spinner-border-sm text-primary mx-auto mb-2" role="status"></div>
                        <span class="text-muted small">Fetching vacancies...</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7 col-xl-8 sticky-top" style="top: 80px; z-index: 10;">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden cardJobDetails bg-white">
                    <div class="bg-primary bg-gradient p-4 text-white">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-start gap-3">
                            <div>
                                <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 extra-small fw-semibold text-uppercase mb-2">Job Preview</span>
                                <h2 class="h3 fw-bold text-white mb-1 spanTitle">Select a Position</h2>
                                <p class="mb-0 text-white-50 small">Click any job posting on the left to view complete details.</p>
                            </div>
                            <div class="text-sm-end text-white-50 extra-small">
                                Posted <br>
                                <span class="fw-bold text-white spanDatePosted">--</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border-bottom bg-light bg-opacity-50">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="bg-white p-3 rounded-3 border text-center">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1">Compensation</span>
                                    <span class="fw-bold text-dark fs-6 spanSalary">--</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-white p-3 rounded-3 border text-center">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1">Location</span>
                                    <span class="fw-bold text-dark fs-6 spanLocation">--</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-white p-3 rounded-3 border text-center">
                                    <span class="d-block text-muted extra-small text-uppercase fw-bold mb-1">Openings</span>
                                    <span class="fw-bold text-dark fs-6 spanNoOfEmp">--</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12 col-md-7">
                                <h6 class="fw-bold text-dark mb-2">Description & Responsibilities</h6>
                                <p class="text-secondary small lh-relaxed spanJobDesc">
                                    No job selected. Select a vacancy card to inspect requirements, location, salary range, and qualification criteria.
                                </p>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="fw-bold text-dark mb-3 small text-uppercase">Overview</h6>
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
