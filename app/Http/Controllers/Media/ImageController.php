<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time().'.'.$imageFile->getClientOriginalExtension();

            // Remove existing profile image for this user if one exists
            $existingImages = Image::where('applicant_id', Auth::id())->get();
            foreach ($existingImages as $existing) {
                if ($existing->file_path && File::exists(public_path('imageUpload/'.$existing->file_path))) {
                    File::delete(public_path('imageUpload/'.$existing->file_path));
                }
            }
            Image::where('applicant_id', Auth::id())->delete();

            // Move new image to public upload folder
            $imageFile->move(public_path('imageUpload'), $imageName);

            // Save new image record
            Image::create([
                'applicant_id' => Auth::id(),
                'name' => $request->input('name'),
                'file_path' => $imageName,
            ]);

            return back()->with('success', 'Profile photo uploaded successfully!')
                ->with('image', $imageName);
        }

        return back()->with('error', 'Please select an image file to upload.');
    }

    public function create()
    {
        return view('media.image-form');
    }
}
