<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $existingUser = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($existingUser) {
                if (empty($existingUser->google_id)) {
                    $existingUser->update(['google_id' => $googleUser->id]);
                }

                Auth::login($existingUser);

                return redirect()->intended('/');
            }

            $newUser = User::create([
                'name' => $googleUser->name,
                'username' => $googleUser->email,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'role_id' => 3,
                'password' => Hash::make(Str::random(32)),
            ]);

            Auth::login($newUser);

            return redirect()->intended('/');

        } catch (Exception $e) {
            return redirect()->route('login.show')
                ->withErrors(['google' => 'Unable to sign in with Google: '.$e->getMessage()]);
        }
    }
}
