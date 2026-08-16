<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Illuminate\Http\Request;

class EducationalBackgroundController extends Controller
{
    public function index()
    {
        $data = Degree::where('educational_background.applicant_id', auth()->user()->id)->latest()->paginate(5);

        //        return view('education.index',compact('data'))
        return view('education.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getEB(Request $request)
    {
        $data = Degree::where('applicant_id', auth()->user()->id)->get();

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'school_name' => 'bail|required|max:255',
            'school_name' => 'required',
            'school_location' => 'required',
            'degree' => 'required',
            'field_of_study' => 'required',
            'month_graduate' => 'required',
            'year_graduate' => 'required',
        ]);
        if (! isset($request->eb_id)) {
            Degree::create([
                'applicant_id' => auth()->user()->id,
                'school_name' => $request->school_name,
                'school_location' => $request->school_location,
                'degree' => $request->degree,
                'field_of_study' => $request->field_of_study,
                'month_graduate' => $request->month_graduate,
                'year_graduate' => $request->year_graduate,
            ]);
        } else {
            Degree::where('id', $request->eb_id)
                ->update([
                    'applicant_id' => auth()->user()->id,
                    'school_name' => $request->school_name,
                    'school_location' => $request->school_location,
                    'degree' => $request->degree,
                    'field_of_study' => $request->field_of_study,
                    'month_graduate' => $request->month_graduate,
                    'year_graduate' => $request->year_graduate,
                ]);
        }

        return response()->json(['result' => 1]);
    }

    public function deleteEB(Request $request)
    {
        $request->validate([
            'eb_id' => 'required',
        ]);

        Degree::where('id', $request->eb_id)
            ->delete();

        return response()->json(['result' => 1]);
    }

    public function getEBById(Request $request)
    {
        $data = Degree::where('id', $request->id)->first();

        return response()->json(['data' => $data]);
    }

    public function show(Degree $educational_background)
    {
        return view('education.show', compact('educational_background'));
    }

    public function edit(Degree $educational_background)
    {
        return view('education.edit', compact('educational_background'));
    }

    public function update(Request $request, Degree $educational_background)
    {
        $request->validate([
            'school_name' => 'required',
            'school_location' => 'required',
            'degree' => 'required',
            'field_of_study' => 'required',
            'month_graduate' => 'required',
            'year_graduate' => 'required',
        ]);

        $educational_background->update($request->all());

        return redirect()->route('educational_background.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Degree $educational_background)
    {
        $educational_background->delete();

        return redirect()->route('educational_background.index')
            ->with('success', 'Post deleted successfully');
    }
}
