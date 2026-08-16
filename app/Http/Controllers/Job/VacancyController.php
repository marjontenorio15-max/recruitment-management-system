<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function index()
    {
        //        $vacancies = Vacancy::latest()->paginate(5);

        $vacancies = Vacancy::where('tbl_job_list.company_id', auth()->user()->id)->select('tbl_job_list.id as id', 'title',
            'tbl_job_list.location', 'no_of_employee', 'salary', 'sex', 'work_exp', 'job_desc',
            'users.username as created_by', 'tbl_job_list.created_at as created_at',
            'users.username as company_name', 'status')->
            leftJoin('users', 'users.id', '=', 'tbl_job_list.created_by')->
            orderBy('tbl_job_list.created_at', 'desc')->simplePaginate(5);

        //        $vacancies = DB::table('tbl_job_list')->select('tbl_job_list');

        //        $vacancies = DB::table('companies')->select('tbl_job_list.title', 'companies.company_id', 'tbl_job_list.job_details',
        //            'tbl_job_list.created_by', 'companies.company_name')->join('tbl_job_list', 'companies.company_id', 'tbl_job_list.company_id' )
        //            ->simplePaginate(5);

        return view('vacancy.index', compact('vacancies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function create()
    {
        return view('vacancy.create');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $request->validate([
            'title' => 'required',
            //            'job_details' => 'required',
            'no_of_employee' => 'required',
            'salary' => 'required',
            //            'duration_employment' => 'required',
            'sex' => 'required',
            //            'section_vacancy'=> 'required',
            'degree' => 'required',
            'work_exp' => 'required',
            'job_desc' => 'required',
            'location' => 'required',

        ]);

        $data = [
            'title' => $request->title,
            'company_id' => auth()->user()->id,
            //            'job_details' => $request->job_details,
            'created_by' => auth()->user()->id,

            'no_of_employee' => $request->no_of_employee,
            'salary' => $request->salary,
            //            'duration_employment' => $request->duration_employment,
            'sex' => $request->sex,
            'degree' => $request->degree,
            //            'section_vacancy' => $request->section_vacancy,
            'work_exp' => $request->work_exp,
            'job_desc' => $request->job_desc,
            'location' => $request->location,
        ];

        Vacancy::create($data);

        return redirect()->route('vacancy.index')
            ->with('success', 'Job created successfully.');

    }

    public function show(Vacancy $vacancy)
    {

        return view('vacancy.show', compact('vacancy'));

    }

    public function edit(Vacancy $vacancy)
    {
        return view('vacancy.edit', compact('vacancy'));
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'title' => 'required',
            //            'job_details' => 'required',
            'no_of_employee' => 'required',
            'salary' => 'required',
            //            'duration_employment' => 'required',
            'sex' => 'required',
            'degree' => 'required',
            //            'section_vacancy'=> 'required',
            'work_exp' => 'required',
            'job_desc' => 'required',
            'location' => 'required',
        ]);

        $vacancy->update($request->all());

        return redirect()->route('vacancy.index')
            ->with('success', 'Job updated successfully');
    }

    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();

        return redirect()->route('vacancy.index')
            ->with('success', 'Post deleted successfully');
    }

    public function updateStatus($id)
    {
        // get product status with the help of product ID
        $product = DB::table('tbl_job_list')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        // Check vacancy status
        if ($product->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        // update icon-switch status
        $values = ['status' => $status];
        DB::table('tbl_job_list')->where('id', $id)->update($values);

        session()->flash('msg', 'Product status has been updated successfully.');

        return redirect('/vacancy');
    }

    public function getVacancies(Request $request)
    {
        $vacancies = DB::table('tbl_job_list')
            ->select(
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
        $apply = Apply::select('*')
            ->join('applicants', 'applicants.applicant_id', '=', 'apply.applicant_id')
            ->orderBy('apply.created_at', 'asc')
            ->where('apply.job_id', $request->jobId)
            ->get();

        return response()->json(['data' => $apply]);
    }
}
