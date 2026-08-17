<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function myFileSave(Request $request)
    {
        $request->validate([
            'myfile' => 'required|file|max:10240',
        ]);

        if ($request->hasFile('myfile')) {
            $path = 'upload_files/';
            $file = $request->file('myfile');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path($path), $fileName);

            return redirect()->back()->with('success', 'File uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Please select a valid file to upload.');
    }
}
