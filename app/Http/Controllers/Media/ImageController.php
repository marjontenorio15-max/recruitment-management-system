<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    // View File To Upload Image
    public function index()
    {
        return view('applicant.accounts');
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'required',
        ]);
        //
        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png', // Only allow .jpg, .bmp and .png file types.
            ]);

            $image = new Image([
                'applicant_id' => auth()->user()->id,
                'name' => $request->get('name'),
                $imageName = time().'.'.$request->image->getClientOriginalName(),
                'file_path' => time().'.'.$request->image->getClientOriginalName(),
                $request->image->move(public_path('imageUpload'), $imageName),
            ]);

            //            foreach ($image as $images) {
            if ($image->applicant_id === auth()->user()->id) {
                File::delete(public_path('imageUpload'.$image->file_path));
                DB::table('image')->where('applicant_id', auth()->user()->id)->delete();
            }
            $image->save();
            //            }

            //            $image->save();
            //            $image->update(['image'=>$imageName]);
            //            $request->file->store('imageUpload', 'public');
            // Store the record, using the new file hashname which will be it's new filename identity.
            // Public Folder// Finally, save the record.
            // Public Folder

            return back()->with('success', 'Image uploaded Successfully!')
                ->with('image', $imageName);

        }

        //        return back()->with('success', 'Image uploaded Successfully!')
        //            ->with('image', $imageName);
        return view('applicant.accounts')->with('success', 'upload image successfully');
    }

    public function create()
    {
        return view('media.image-form');
    }
}
