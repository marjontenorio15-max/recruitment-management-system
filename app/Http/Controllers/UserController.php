<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserEmail;
use Mail;

class UserController extends Controller
{

    public function index(Request $request)
    {
//        $users = DB::table('users')->orderBy('role_id')->get();
        $users = DB::table('users')->orderBy('role_id')
            ->simplePaginate(20);

        return view('manage_user.manage-user', compact('users'));
    }


    public function sendEmail(Request $request)
    {

        $users = User::whereIn('id', $request->ids)->get();

        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new UserEmail($user));
        }

        return response()->json(['success'=>'Send email successfully.']);
    }
}
