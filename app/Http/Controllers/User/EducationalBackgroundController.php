<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationalBackgroundController extends Controller
{
    public function index()
    {
        $data = Degree::where('applicant_id', Auth::id())->latest()->paginate(5);

        return view('education.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getEB(Request $request)
    {
        $data = Degree::where('applicant_id', Auth::id())->get();

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'school_location' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'month_graduate' => 'required|string|max:255',
            'year_graduate' => 'required|numeric',
        ]);

        if (empty($request->eb_id)) {
            $validated['applicant_id'] = Auth::id();
            Degree::create($validated);
        } else {
            Degree::where('id', $request->eb_id)
                ->where('applicant_id', Auth::id())
                ->update($validated);
        }

        return response()->json(['result' => 1]);
    }

    public function deleteEB(Request $request)
    {
        $request->validate([
            'eb_id' => 'required',
        ]);

        Degree::where('id', $request->eb_id)
            ->where('applicant_id', Auth::id())
            ->delete();

        return response()->json(['result' => 1]);
    }

    public function getEBById(Request $request)
    {
        $data = Degree::where('id', $request->id)
            ->where('applicant_id', Auth::id())
            ->first();

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
