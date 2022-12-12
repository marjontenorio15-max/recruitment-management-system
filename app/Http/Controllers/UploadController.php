<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function myFileSave(Request $request){
        $path="upload_files/";
        $file = $request->file('myfile');
//        $savetodb = $path + $file;
        $upload=$file->move(public_path($path), $file->getClientOriginalName());
        if ($upload){
            echo '<script>alert("uploaded")</script>';
        }else{
            echo '<script>alert("sorry")</script>';
        }

    }

}
