<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyController extends Controller
{
    public function index()
    {
        $query = Apply::query()
            ->join('tbl_job_list', 'apply.job_id', '=', 'tbl_job_list.id')
            ->join('applicants', 'apply.applicant_id', '=', 'applicants.applicant_id')
            ->join('companies', 'tbl_job_list.company_id', '=', 'companies.company_id')
            ->select(
                'apply.remarks',
                'apply.id',
                'applicants.file_attachment',
                'apply.created_at',
                'tbl_job_list.title',
                'companies.company_name',
                'applicants.first_name',
                'applicants.last_name',
                'applicants.middle_name',
                'apply.description'
            );

        if (Auth::check() && Auth::user()->role_id == 2) {
            $query->where('tbl_job_list.company_id', Auth::id());
        }

        $data = $query->latest('apply.created_at')->simplePaginate(10);

        return view('applications.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required',
            'applicant_id' => 'required',
            'remarks' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Apply::create($validated);

        return redirect()->route('apply.index')
            ->with('success', 'Created successfully.');
    }

    public function applyJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
        ]);

        $applicantId = Auth::id();

        $existing = Apply::where('job_id', $request->job_id)
            ->where('applicant_id', $applicantId)
            ->first();

        if ($existing) {
            return response()->json(['result' => 2]);
        }

        Apply::create([
            'job_id' => $request->job_id,
            'applicant_id' => $applicantId,
            'remarks' => $request->remarks ?? 'Pending',
            'description' => '',
        ]);

        return response()->json(['result' => 1]);
    }

    public function show(Apply $apply)
    {
        return view('applications.show', compact('apply'));
    }

    public function edit(Apply $apply)
    {
        return view('applications.edit', compact('apply'));
    }

    public function update(Request $request, Apply $apply)
    {
        $validated = $request->validate([
            'remarks' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $apply->update($validated);

        return redirect()->route('apply.index')
            ->with('success', 'Updated successfully');
    }

    public function destroy(Apply $apply)
    {
        $apply->delete();

        return redirect()->route('apply.index')
            ->with('success', 'Deleted successfully');
    }

    /**
     * @param  int|string  $id
     * @return View|RedirectResponse
     */
    public function get($id)
    {
        $vacancy = Vacancy::find($id);

        if (! $vacancy) {
            return redirect()->route('view-jobs')->with('error', 'Job vacancy not found.');
        }

        $appliedApplicant = Apply::select('apply.job_id')
            ->where('apply.applicant_id', Auth::id())
            ->where('apply.job_id', $id)->first();

        if ($appliedApplicant) {
            return redirect()->back()->with(['message' => 'You already applied to this job!'], compact('vacancy'));
        }

        Apply::create([
            'applicant_id' => Auth::id(),
            'job_id' => $vacancy->id,
            'remarks' => 'Pending',
            'description' => '',
        ]);

        return view('vacancy.success', compact('vacancy'));
    }

    public function get_applicants(Request $request)
    {
        $user = Auth::user();

        // Start base query
        $query = Apply::query()
            ->join('tbl_job_list', 'apply.job_id', '=', 'tbl_job_list.id')
            ->join('applicants', 'apply.applicant_id', '=', 'applicants.applicant_id')
            ->join('companies', 'tbl_job_list.company_id', '=', 'companies.company_id')
            ->select(
                'apply.id',
                'apply.remarks',
                'apply.created_at',
                'tbl_job_list.title',
                'companies.company_name',
                'applicants.file_attachment',
                'applicants.first_name',
                'applicants.last_name',
                'applicants.middle_name',
                'applicants.email_address',
                'applicants.contact_no',
                'applicants.address',
                'applicants.city',
                'applicants.state',
                'applicants.zipcode',
                'applicants.degree'
            );

        // Apply role-based filter
        if ($user->role_id == 2) {
            $query->where('tbl_job_list.company_id', $user->id);
        }

        // Search / Filter by Remarks (Case-insensitive & Partial Match)
        if ($request->filled('remarks') && strtolower($request->remarks) !== 'all') {
            $searchTerm = '%'.strtolower(trim($request->remarks)).'%';
            $query->whereRaw('LOWER(apply.remarks) LIKE ?', [$searchTerm]);
        }

        $applicants = $query->latest('apply.created_at')->get();
        $selectedRemark = $request->get('remarks', 'All');

        return view('reports.index', compact('applicants', 'selectedRemark'));
    }
}
