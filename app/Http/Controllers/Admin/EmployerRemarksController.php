<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployerRemarksController extends Controller
{
    public function index()
    {
        $data = Apply::latest()->simplePaginate(5);

        return view('employer-remarks.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('employer-remarks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant_id' => 'required',
            'remarks' => 'required',

        ]);

        Apply::create($request->all());

        return redirect()->route('employer_remarks.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(Apply $employer_remark)
    {

        if (in_array(auth()->user()->role_id, [1, 2])) {
            return view('employer-remarks.show', compact('employer_remark'));
        } else {
            return view('applicant.dashboard', compact('employer_remark'));
        }
    }

    public function edit(Apply $employer_remark)
    {

        //        $remark = \DB::table('apply')
        //            ->where('apply.applicant_id', $employer_remark->applicant_id)
        //            ->join('applicants','apply.applicant_id', 'applicants.applicant_id')
        //            ->select('apply.applicant_id', 'apply.remarks')
        //            ->get();
        return view('employer-remarks.edit', compact('employer_remark'));
    }

    public function update(Request $request, Apply $employer_remark)
    {

        $request->validate([
            'remarks' => 'required',
        ]);

        $employer_remark->update($request->all());

        $applicants = DB::table('apply')
            ->when(auth()->user()->role_id != 1, function ($q) {
                return $q->where('tbl_job_list.company_id', auth()->user()->id);
            })
            ->where('apply.id', $employer_remark->id)
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
            ->join('users', 'apply.applicant_id', 'users.id')
            ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
            ->select('apply.remarks', 'apply.id', 'applicants.file_attachment',
                'apply.created_at', 'tbl_job_list.title', 'companies.company_name',
                'applicants.first_name', 'applicants.last_name', 'applicants.middle_name', 'apply.description', 'users.email')
            ->orderBy('apply.created_at', 'desc')->first();

        if ($applicants != null) {
            $subject = 'Application Status Update';
            $to_email = $applicants->email;
            $to_name = $applicants->first_name.' '.$applicants->last_name;
            $data['to_name'] = $to_name;
            $data['applicants'] = $applicants;

            try {
                Mail::send('mail.job_update', $data, function ($message) use ($to_name, $to_email, $subject) {
                    $message->to($to_email, $to_name)
                        ->subject($subject);
                    $message->from('aei.rms.system@gmail.com', 'AEI - RMS');
                });
            } catch (\Throwable $e) {
                // Ignore mail transport failure during local dev
            }
        }

        if (auth()->user()->role_id == 2) {
            return redirect()->route('employer-applicant-table-record')
                ->with('success', 'Post updated successfully');
        } else {
            return redirect()->route('apply.index')
                ->with('success', 'Post updated successfully');
        }
    }

    public function destroy(Apply $employer_remark)
    {

        $employer_remark->delete();

        if (auth()->user()->role_id == 2) {
            return redirect()->route('employer-applicant-table-record')
                ->with('success', 'Post deleted successfully');
        } else {
            return redirect()->route('apply.index')
                ->with('success', 'Post deleted successfully');
        }
    }
}
