<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpController extends Controller
{
    public function index()
    {
        $data = Exp::where('applicant_id', Auth::id())->latest()->paginate(5);

        return view('work-experience.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getWE(Request $request)
    {
        $data = Exp::where('applicant_id', Auth::id())->get();

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
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'period_employed' => 'required|string|max:255',
            'achievements' => 'required|string',
        ]);

        $validated['applicant_id'] = Auth::id();

        if (! isset($request->we_id)) {
            if ($request->hasFile('certificate')) {
                $fileName = time().'_'.$request->file('certificate')->getClientOriginalName();
                $request->file('certificate')->storeAs('uploads', $fileName, 'public');
                $validated['certificate'] = $fileName;
            }

            Exp::create($validated);
        } else {
            if ($request->hasFile('certificate')) {
                $fileName = time().'_'.$request->file('certificate')->getClientOriginalName();
                $request->file('certificate')->storeAs('uploads', $fileName, 'public');
                $validated['certificate'] = $fileName;
            }

            Exp::where('id', $request->we_id)
                ->where('applicant_id', Auth::id())
                ->update($validated);
        }

        return response()->json(['result' => 1]);
    }

    public function deleteWE(Request $request)
    {
        $request->validate([
            'we_id' => 'required',
        ]);

        Exp::where('id', $request->we_id)
            ->where('applicant_id', Auth::id())
            ->delete();

        return response()->json(['result' => 1]);
    }

    public function getWEById(Request $request)
    {
        $data = Exp::where('id', $request->id)
            ->where('applicant_id', Auth::id())
            ->first();

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
