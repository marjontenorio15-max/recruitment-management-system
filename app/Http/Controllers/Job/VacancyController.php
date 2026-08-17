<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role_id == 3) {
            return redirect()->route('view-jobs');
        }

        $query = Vacancy::select(
            'tbl_job_list.id as id',
            'tbl_job_list.title',
            'tbl_job_list.location',
            'tbl_job_list.no_of_employee',
            'tbl_job_list.salary',
            'tbl_job_list.sex',
            'tbl_job_list.work_exp',
            'tbl_job_list.job_desc',
            'users.name as created_by',
            'users.username',
            'companies.company_name',
            'tbl_job_list.created_at',
            'tbl_job_list.status'
        )
            ->leftJoin('users', 'users.id', '=', 'tbl_job_list.created_by')
            ->leftJoin('companies', 'companies.company_id', '=', 'tbl_job_list.company_id')
            ->orderBy('tbl_job_list.created_at', 'desc');

        if (Auth::check() && Auth::user()->role_id != 1) {
            $query->where(function ($q) {
                $q->where('tbl_job_list.company_id', Auth::id())
                    ->orWhere('tbl_job_list.created_by', Auth::id());
            });
        }

        $vacancies = $query->paginate(10);

        return view('vacancy.index', compact('vacancies'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        if (! Auth::check() || ! in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('view-jobs')->with('error', 'Only employers and administrators can post vacancies.');
        }

        return view('vacancy.create');
    }

    public function store(Request $request)
    {
        if (! Auth::check() || ! in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('view-jobs')->with('error', 'Only employers and administrators can post vacancies.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'no_of_employee' => 'required',
            'salary' => 'required|string|max:255',
            'sex' => 'required|string',
            'degree' => 'required|string',
            'work_exp' => 'required|string',
            'job_desc' => 'required|string',
            'location' => 'required|string',
        ]);

        $validated['company_id'] = Auth::id();
        $validated['created_by'] = Auth::id();
        $validated['status'] = 1;

        Vacancy::create($validated);

        return redirect()->route('vacancy.index')
            ->with('success', 'Job created successfully.');
    }

    public function show(Vacancy $vacancy)
    {
        return view('vacancy.show', compact('vacancy'));
    }

    public function edit(Vacancy $vacancy)
    {
        if (! Auth::check() || ! in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('view-jobs')->with('error', 'Unauthorized action.');
        }

        if (Auth::user()->role_id == 2 && $vacancy->created_by != Auth::id() && $vacancy->company_id != Auth::id()) {
            abort(403, 'Unauthorized: You can only edit your own vacancies.');
        }

        return view('vacancy.edit', compact('vacancy'));
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        if (! Auth::check() || ! in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('view-jobs')->with('error', 'Unauthorized action.');
        }

        if (Auth::user()->role_id == 2 && $vacancy->created_by != Auth::id() && $vacancy->company_id != Auth::id()) {
            abort(403, 'Unauthorized: You can only update your own vacancies.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'no_of_employee' => 'required',
            'salary' => 'required|string|max:255',
            'sex' => 'required|string',
            'degree' => 'required|string',
            'work_exp' => 'required|string',
            'job_desc' => 'required|string',
            'location' => 'required|string',
        ]);

        $vacancy->update($validated);

        return redirect()->route('vacancy.index')
            ->with('success', 'Job updated successfully');
    }

    public function destroy(Vacancy $vacancy)
    {
        if (! Auth::check() || ! in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('view-jobs')->with('error', 'Unauthorized action.');
        }

        if (Auth::user()->role_id == 2 && $vacancy->created_by != Auth::id() && $vacancy->company_id != Auth::id()) {
            abort(403, 'Unauthorized: You can only delete your own vacancies.');
        }

        $vacancy->delete();

        return redirect()->route('vacancy.index')
            ->with('success', 'Post deleted successfully');
    }

    /**
     * @param  int|string  $id
     * @return RedirectResponse
     */
    public function updateStatus($id)
    {
        $product = Vacancy::find($id);

        if (! $product) {
            return redirect()->route('vacancy.index')->with('error', 'Vacancy record not found.');
        }

        if (Auth::check() && Auth::user()->role_id == 2 && $product->created_by != Auth::id() && $product->company_id != Auth::id()) {
            abort(403, 'Unauthorized: You can only change the status of your own vacancies.');
        }

        $newStatus = ($product->status == '1' || $product->status == 1) ? '0' : '1';

        $product->update(['status' => $newStatus]);

        session()->flash('msg', 'Vacancy status has been updated successfully.');

        return redirect()->route('vacancy.index');
    }

    public function getVacancies(Request $request)
    {
        $vacancies = Vacancy::select(
            'tbl_job_list.id as id',
            'tbl_job_list.title',
            'tbl_job_list.company_id',
            'tbl_job_list.location',
            'tbl_job_list.degree',
            'tbl_job_list.no_of_employee',
            'tbl_job_list.salary',
            'tbl_job_list.sex',
            'tbl_job_list.work_exp',
            'tbl_job_list.job_desc',
            'users.name as created_by',
            'users.username',
            'companies.company_name',
            'tbl_job_list.created_at',
            'tbl_job_list.status'
        )
            ->leftJoin('users', 'users.id', '=', 'tbl_job_list.created_by')
            ->leftJoin('companies', 'companies.company_id', '=', 'tbl_job_list.company_id')
            ->orderBy('tbl_job_list.created_at', 'desc');

        if ($request->filled('title')) {
            $vacancies->where('tbl_job_list.title', 'like', '%'.$request->title.'%');
        }

        if ($request->filled('created_by')) {
            $vacancies->where(function ($q) use ($request) {
                $q->where('users.name', 'like', '%'.$request->created_by.'%')
                    ->orWhere('users.username', 'like', '%'.$request->created_by.'%')
                    ->orWhere('companies.company_name', 'like', '%'.$request->created_by.'%');
            });
        }

        if ($request->filled('location')) {
            $vacancies->where('tbl_job_list.location', 'like', '%'.$request->location.'%');
        }

        $vacancies = $vacancies->get();

        return response()->json(['vacancies' => $vacancies]);
    }

    public function getBestApplicant(Request $request)
    {
        $jobId = Apply::select('*')
            ->join('applicants', 'applicants.applicant_id', '=', 'apply.applicant_id')
            ->orderBy('apply.created_at', 'asc')
            ->where('apply.job_id', $request->jobId)
            ->get();

        return response()->json(['data' => $jobId]);
    }
}
