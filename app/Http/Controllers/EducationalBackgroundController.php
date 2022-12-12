<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

class EducationalBackgroundController extends Controller
{


    public function index()
    {
        $data = Degree::where('educational_background.applicant_id', auth()->user()->id)->latest()->paginate(5);

//        return view('Degree.index',compact('data'))
        return view('Degree.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    public function create()
    {
        return view('Degree.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'bail|required|unique:posts|max:255',
            'school_location' => 'required',
            'degree' => 'required',
            'field_of_study' => 'required',
            'month_graduate' => 'required',
            'year_graduate' => 'required',
        ]);

        Degree::create([
            'applicant_id' => auth()->user()->id,
            'school_name' => $request->school_name,
            'school_location' =>  $request->school_location,
            'degree' =>  $request->degree,
            'field_of_study' =>  $request->field_of_study,
            'month_graduate' => $request->month_graduate,
            'year_graduate' =>  $request->year_graduate,
//            $request->all()
        ]);

        return redirect()->route('educational_background.index')
            ->with('success','Post created successfully.');
    }



    public function show(Degree $educational_background)
    {
        return view('Degree.show', compact('educational_background'));
    }



    public function edit(Degree $educational_background)
    {
        return view('Degree.edit',compact('educational_background'));
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
            ->with('success','Post updated successfully');
    }


    public function destroy(Degree $educational_background)
    {
        $educational_background->delete();

        return redirect()->route('educational_background.index')
            ->with('success','Post deleted successfully');
    }
}
