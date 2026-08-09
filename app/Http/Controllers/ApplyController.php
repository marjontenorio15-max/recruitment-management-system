<?php

namespace App\Http\Controllers;


use App\Http\Livewire\Applicants;
use App\Models\Applicant;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\Apply;
use Illuminate\Database\Eloquent\Model;
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

    public function applyJob(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
       $request->validate([
           'job_id' => 'required',
       ]);

       $request->this->applicant_id = auth()->user()->id;

       $validate = Apply::where('job_id', $request->job_id)
       ->where('applicant_id', $request->applicant_id)
       ->get();

       if(count($validate) > 0) {
            return response()->json(['result' => 2]);
       }
       else{
            Apply::insert([
                'job_id' => $request->job_id,
                'applicant_id' => auth()->user()->id,
                'remarks' => $request->remarks,
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => 1]);
       }

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
    public function get(Request $id)
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

    public function get_applicants(Request $request)
    {
        $user = auth()->user();

        // Start base query
        $query = DB::table('apply')
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
            $searchTerm = '%' . strtolower(trim($request->remarks)) . '%';
            $query->whereRaw('LOWER(apply.remarks) LIKE ?', [$searchTerm]);
        }

        $applicants = $query->latest('apply.created_at')->get();
        $selectedRemark = $request->get('remarks', 'All');

        return view('generate-reports', compact('applicants', 'selectedRemark'));
    }

}
