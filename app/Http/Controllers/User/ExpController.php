<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('experience')->where('experience.applicant_id', auth()->user()->id)->latest()->paginate(5);

        return view('work-experience.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getWE(Request $request)
    {
        $data = DB::table('experience')->where('experience.applicant_id', auth()->user()->id)->get();

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        return view('work-experience.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'period_employed' => 'required',
            'achievements' => 'required',
        ]);

        Exp::create($request->all());

        return redirect()->route('job-experience.index')
            ->with('success', 'Job Experience created successfully.');
    }

    public function saveWE(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'period_employed' => 'required',
            'achievements' => 'required',
        ]);

        if (! isset($request->we_id)) {
            $fileName = null;

            if ($request->file()) {
                $fileName = time().'_'.$request->certificate->getClientOriginalName();
                $filePath = $request->file('certificate')->storeAs('uploads', $fileName, 'public');

                Exp::create(array_merge($request->all(), ['certificate' => $fileName, 'applicant_id' => auth()->user()->id]));
            } else {
                Exp::create(array_merge($request->all(), ['applicant_id' => auth()->user()->id]));
            }
        } else {

            $data = [
                'job_title' => $request->job_title,
                'company_name' => $request->company_name,
                'period_employed' => $request->period_employed,
                'achievements' => $request->achievements,
            ];

            $fileName = null;

            if ($request->file()) {
                $fileName = time().'_'.$request->certificate->getClientOriginalName();
                $filePath = $request->file('certificate')->storeAs('uploads', $fileName, 'public');

                $data['certificate'] = $fileName;
            }

            Exp::where('id', $request->we_id)
                ->update($data);
        }

        return response()->json(['result' => 1]);
    }

    public function deleteWE(Request $request)
    {
        $request->validate([
            'we_id' => 'required',
        ]);

        Exp::where('id', $request->we_id)
            ->delete();

        return response()->json(['result' => 1]);
    }

    public function getWEById(Request $request)
    {
        $data = Exp::where('id', $request->id)->first();

        return response()->json(['data' => $data]);
    }

    public function show(Exp $job_experience)
    {
        return view('work-experience.show', compact('job_experience'));
    }

    public function edit(Exp $job_experience)
    {
        return view('work-experience.edit', compact('job_experience'));
    }

    public function update(Request $request, Exp $job_experience)
    {
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'period_employed' => 'required',
            'achievements' => 'required',
        ]);

        $job_experience->update($request->all());

        return redirect()->route('job-experience.index')
            ->with('success', 'Job Experience updated successfully');
    }

    public function destroy(Exp $job_experience)
    {
        $job_experience->delete();

        return redirect()->route('job-experience.index')
            ->with('success', 'Job Experience deleted successfully');
    }
}
