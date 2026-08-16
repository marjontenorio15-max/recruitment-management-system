@extends('layouts.app-master')

@section('content')
<div class="container-fluid">
    <div class="card m-3 shadow">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-sm-4"></div>
                <div class="col-sm-5">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('reports.index') }}" id="filterForm" class="d-flex align-items-center justify-content-end">
                        <span class="text-white me-2">Remarks:</span>
                        <select name="remarks" class="form-select w-auto" onchange="document.getElementById('filterForm').submit()">
                            <option value="All" {{ $selectedRemark == 'All' ? 'selected' : '' }}>All</option>
                            <option value="Pending" {{ $selectedRemark == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="For Interview" {{ $selectedRemark == 'For Interview' ? 'selected' : '' }}>For Interview</option>
                            <option value="Reject" {{ $selectedRemark == 'Reject' ? 'selected' : '' }}>Reject</option>
                            <option value="Hired" {{ $selectedRemark == 'Hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                    </form>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-success shadow float-end" type="button" onclick="window.print()">
                        Generate Report
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="tab">
                <h3>List of Applicants</h3>
                <table class="table table-bordered shadow tblApplicants">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Job Title</th>
                            <th>Email Address</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Company</th>
                            <th>Degree</th>
                            <th>Date Applied</th>
                            <th>Status | Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicants as $app)
                            <tr>
                                <td>{{ trim("{$app->first_name} {$app->middle_name} {$app->last_name}") ?: 'N/A' }}</td>
                                <td>{{ $app->title }}</td>
                                <td>{{ $app->email_address }}</td>
                                <td>{{ $app->contact_no }}</td>
                                <td>{{ implode(', ', array_filter([$app->address, $app->city, $app->state, $app->zipcode])) }}</td>
                                <td>{{ $app->company_name }}</td>
                                <td>{{ $app->degree }}</td>
                                <td>{{ \Carbon\Carbon::parse($app->created_at)->format('M d, Y') }}</td>
                                <td>{{ $app->remarks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No applicants found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

