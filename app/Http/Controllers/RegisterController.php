<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    public function show()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
//        $data = $request->all();
          $user = User::create(array_merge($request->all(), ['role_id' => '3']));
//        $check = User::create($data);

//        return redirect("dashboard")->withSuccess('You have signed-in');

//        $user = User::create($request->validated());

        if($user->role_id == 3):
//            return "role id is 3";
            auth()->login($user);
            return redirect('/view-jobs')->with('success', "Account successfully registered.");
//            return view('employee.create-employee');

        // employer eto yung nagkecreate ng mga job posting
        elseif($user->role_id == 2):
            return view('employee.create-employee');

        // super admin
        elseif($user->role_id == 1):
            return view('auth.login');
        endif;


        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function employee(RegisterRequest $request)
    {

        $user = User::create(array_merge($request->all(), ['role_id' => '2']));

        auth()->login($user);

        return redirect('/create-employer')->with('success', "Employee Account successfully registered.");
    }


}
