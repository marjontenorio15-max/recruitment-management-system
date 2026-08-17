<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('role_id')
            ->simplePaginate(20);

        return view('users.index', compact('users'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $users = User::whereIn('id', $request->ids)->get();

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new UserEmail($user));
            } catch (\Throwable $e) {
                // Ignore mail transport failure during local dev
            }
        }

        return response()->json(['success' => 'Send email successfully.']);
    }
}
