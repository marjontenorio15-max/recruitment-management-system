<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;

class LoginController extends Controller
{
    use RememberMeExpiration;


    public function show()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->get('remember'));

        if($request->get('remember')):
            $this->setRememberMeExpiration($user);
        endif;

        if($user->role_id == 3):
//            return "role id is 3";
            return view('view_jobs.view-jobs');

        // employer eto yung nagkecreate ng mga job posting
        elseif($user->role_id == 2):
            return view('home.index');

        // super admin kayo to
        elseif($user->role_id == 1):
            return redirect()->intended('dashboard');
        endif;

        return $this->authenticated($request, $user);
    }


    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended('/home');
    }
}
