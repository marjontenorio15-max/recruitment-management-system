<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Apply;
use App\Models\Employer_Remarks;
use Illuminate\Http\Request;


class Employer_RemarksController extends Controller
{

    public function index()
    {
        $data = Apply::latest()->simplePaginate(5);

        return view('employer_remarks.index-employer-remarks',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('employer_remarks.create-employer-remarks');
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant_id' => 'required',
            'remarks' => 'required',

        ]);

        Apply::create($request->all());

        return redirect()->route('employer_remarks.index')
            ->with('success','Post created successfully.');
    }

    public function show(Apply $employer_remark)
    {



        if ((auth()->user()->role_id = 2) AND (auth()->user()->role_id = 1))
            return view('employer_remarks.show-employer-remarks', compact('employer_remark'));
        else
            return view('applicant-Jobs', compact('employer_remark'));
    }
    public function edit(Apply $employer_remark)
    {

//        $remark = \DB::table('apply')
//            ->where('apply.applicant_id', $employer_remark->applicant_id)
//            ->join('applicants','apply.applicant_id', 'applicants.applicant_id')
//            ->select('apply.applicant_id', 'apply.remarks')
//            ->get();
        return view('employer_remarks.edit-employer-remarks', compact( 'employer_remark'));
    }

    public function update(Request $request, Apply $employer_remark)
    {

        $request->validate([
            'remarks' => 'required',
        ]);

        $employer_remark->update($request->all());

        if (auth()->user()->role_id == 2)
            return redirect()->route('employer-applicant-table-record')
                ->with('success','Post updated successfully');
        else
            return redirect()->route('apply.index')
            ->with('success','Post updated successfully');
    }

    public function destroy(Apply $employer_remark)
    {

        $employer_remark->delete();

        if (auth()->user()->role_id == 2)
            return redirect()->route('employer-applicant-table-record')
                ->with('success','Post deleted successfully');
        else
            return redirect()->route('apply.index')
                ->with('success','Post deleted successfully');
    }
}
