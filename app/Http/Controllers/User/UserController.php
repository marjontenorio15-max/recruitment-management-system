<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //        $users = DB::table('users')->orderBy('role_id')->get();
        $users = DB::table('users')->orderBy('role_id')
            ->simplePaginate(20);

        return view('users.index', compact('users'));
    }

    public function sendEmail(Request $request)
    {

        $users = User::whereIn('id', $request->ids)->get();

        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new UserEmail($user));
        }

        return response()->json(['success' => 'Send email successfully.']);
    }
}
