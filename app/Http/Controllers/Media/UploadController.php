<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function myFileSave(Request $request)
    {
        $path = 'upload_files/';
        $file = $request->file('myfile');
        //        $savetodb = $path + $file;
        $upload = $file->move(public_path($path), $file->getClientOriginalName());
        if ($upload) {
            echo '<script>alert("uploaded")</script>';
        } else {
            echo '<script>alert("sorry")</script>';
        }

    }
}
