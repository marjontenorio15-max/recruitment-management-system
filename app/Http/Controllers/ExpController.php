<?php

namespace App\Http\Controllers;

use App\Models\Exp;
use Illuminate\Http\Request;

class ExpController extends Controller
{
    //
    public function index()
    {
        $data = \DB::table('experience')->where('experience.applicant_id', auth()->user()->id)->latest()->paginate(5);

        return view('job_experience.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('job_experience.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'period_employed' => 'required',
            'achievements' => 'required'
        ]);

        Exp::create($request->all());

        return redirect()->route('job-experience.index')
            ->with('success','Job Experience created successfully.');
    }


    public function show(Exp $job_experience)
    {
        return view('job_experience.show',compact('job_experience'));
    }


    public function edit(Exp $job_experience)
    {
        return view('job_experience.edit',compact('job_experience'));
    }


    public function update(Request $request, Exp $job_experience)
    {
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'period_employed' => 'required',
            'achievements' => 'required'
        ]);

        $job_experience->update($request->all());

        return redirect()->route('job-experience.index')
            ->with('success','Job Experience updated successfully');
    }


    public function destroy(Exp $job_experience)
    {
        $job_experience->delete();

        return redirect()->route('job-experience.index')
            ->with('success','Job Experience deleted successfully');
    }
}
