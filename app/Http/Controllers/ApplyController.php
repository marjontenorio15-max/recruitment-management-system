<?php

namespace App\Http\Controllers;


use App\Http\Livewire\Applicants;
use App\Models\Applicant;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\Apply;
use Illuminate\Support\Facades\DB;


class ApplyController extends Controller
{

    public function index()
    {
        $data = DB::table('apply')
//            ->where('tbl_job_list.company_id', auth()->user()->id)
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
            ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
            ->select('apply.remarks', 'apply.id', 'applicants.file_attachment',
                'apply.created_at', 'tbl_job_list.title', 'companies.company_name',
                'applicants.first_name', 'applicants.last_name', 'applicants.middle_name', 'apply.description')
            ->simplePaginate(10);

//        $data = Apply::latest()->paginate(5);

        return view('apply.index_apply',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('apply.create_apply');
    }


    public function store(Request $request)
    {
//        $request->validate([
//            'job_id' => 'required',
//            'applicant_id' => 'required',
//
//        ]);

        Apply::create($request->all());

        return redirect()->route('apply.index')
            ->with('success','Created successfully.');
    }


    public function show(Apply $apply)
    {
        return view('apply.show_apply',compact('apply'));
    }


    public function edit(Apply $apply)
    {
        return view('apply.edit_apply',compact('apply'));
    }

    public function update(Request $request, Apply $apply)
    {
//        $request->validate([
////            'job_id' => 'required',
////            'applicant_id' => 'required',
//        ]);

        $apply->update($request->all());

        return redirect()->route('apply.index')
            ->with('success','Updated successfully');
    }


    public function destroy(Apply $apply)
    {
        $apply->delete();

        return redirect()->route('apply.index')
            ->with('success','Deleted successfully');
    }
    public function get($id)
    {
        $vacancy = DB::table('tbl_job_list')->find($id);
//        $get = $id;
        $appliedApplicant = DB::table('apply')->select('apply.job_id')
            ->where('apply.applicant_id',auth()->user()->id)
            ->where('apply.job_id', $id)->get();

       foreach ($appliedApplicant as $applicants){
           if ($applicants->job_id == $id){
               return redirect()->back()->with(['message' => 'You already applied to this job!'], compact('vacancy'));
           }
       }
        Apply::create([
            'applicant_id' => auth()->user()->id,
            'job_id' => $vacancy->id,
            'remarks' => 'Pending',
            'description' => '',
        ]);
        return view('vacancy.success', compact('vacancy'));
    }

//        $applicants = DB::table('applicants')->where('applicants.applicant_id',auth()->user()->id)->get();
//        Applicant::create([
//            //            $data,$data2,
//            'applicant_id' => auth()->user()->id,
//            'job_id' => $id,
//            'first_name' => $applicants->first_name,
//            'last_name' => $applicants->last_name,
//            'middle_name' => $applicants->middle_name,
//            'address' => $applicants->address,
//            'sex' => $applicants->sex,
//            'civil_status' => $applicants->civil_status,
//            'birth_date' => $applicants->birth_date,
//            'birth_place' => $applicants->birth_place,
//            'age' => $applicants->age,
//            //            'user_name' => $this->user_name,
//            //            'password' => $this->password,
//            'email_address' => $applicants->email_address,
//            'contact_no' => $applicants->contact_no,
//            'degree' => $applicants->degree,
//            'file_attachment' => $applicants->file_attachment
//
//        ]);


}
