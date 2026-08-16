<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Applicant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->storeUserAndApplicant($request, roleId: 3);

        auth()->login($user);

        return redirect('/view-jobs')->with('success', 'Account successfully registered.');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        $otp = random_int(100000, 999999);
        $toEmail = $request->email;
        $toName = trim("{$request->firstname} {$request->lastname}");

        session(['otp' => $otp, 'otp_email' => $toEmail]);

        try {
            Mail::send('mail.otp', ['otp' => $otp, 'to_name' => $toName], function ($message) use ($toName, $toEmail) {
                $message->to($toEmail, $toName)
                    ->subject('Your OTP Verification Code');
                $message->from('aei.rms.system@gmail.com', 'AEI - RMS');
            });
        } catch (\Throwable $e) {
            // Log mail failure if any but allow process if needed
        }

        return response()->json(['result' => 1, 'message' => 'OTP sent successfully to your email.']);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $sessionOtp = session('otp');

        if ($sessionOtp && (string) $sessionOtp === (string) $request->otp) {
            try {
                $user = $this->storeUserAndApplicant($request, roleId: 3);
                auth()->login($user);

                session()->forget(['otp', 'otp_email']);

                return response()->json([
                    'result' => 1,
                    'message' => 'Registration successful!',
                    'redirect' => url('/view-jobs'),
                ]);
            } catch (\Throwable $e) {
                return response()->json(['result' => 0, 'message' => 'Registration failed: '.$e->getMessage()]);
            }
        }

        return response()->json(['result' => 0, 'message' => 'Invalid OTP!']);
    }

    public function edit_profile(Request $request)
    {
        $age = $request->filled('birth_date') ? Carbon::parse($request->birth_date)->age : null;

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'birth_place' => $request->birth_place,
            'age' => $age,
            'contact_no' => $request->contact_no,
            'degree' => $request->degree,
        ];

        if ($request->hasFile('myfile')) {
            $fileName = time().'_'.$request->file('myfile')->getClientOriginalName();
            $request->file('myfile')->storeAs('uploads', $fileName, 'public');
            $data['file_attachment'] = $fileName;
        }

        Applicant::where('applicant_id', auth()->id())->update($data);

        return response()->json([
            'result' => 1,
            'fileName' => $data['file_attachment'] ?? null,
        ]);
    }

    private function storeUserAndApplicant(Request $request, int $roleId): User
    {
        return DB::transaction(function () use ($request, $roleId) {
            $username = $request->filled('username')
                ? $request->username
                : explode('@', $request->email)[0];

            $user = User::create([
                'name' => trim("{$request->firstname} {$request->middlename} {$request->lastname}"),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename,
                'email' => $request->email,
                'username' => $username,
                'password' => $request->password, // Hashed automatically by User model mutator
                'role_id' => $roleId,
            ]);

            Applicant::create([
                'applicant_id' => $user->id,
                'first_name' => $request->firstname ?? '',
                'last_name' => $request->lastname ?? '',
                'middle_name' => $request->middlename ?? '',
                'address' => $request->address ?? '',
                'city' => $request->city ?? '',
                'state' => $request->state ?? '',
                'zipcode' => $request->zipcode ?? '',
                'sex' => $request->sex ?? '',
                'civil_status' => $request->civil_status ?? '',
                'birth_date' => $request->birth_date ?? null,
                'birth_place' => $request->birth_place ?? '',
                'age' => $request->age ?? 0,
                'email_address' => $request->email ?? '',
                'contact_no' => $request->contact_no ?? 0,
                'degree' => $request->degree ?? '',
                'file_attachment' => '',
                'remarks' => 'Pending',
            ]);

            return $user;
        });
    }
}
