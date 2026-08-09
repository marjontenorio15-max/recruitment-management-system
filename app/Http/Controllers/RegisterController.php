<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /**
     * Show the registration view.
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle standard web registration form submission.
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->storeUserAndApplicant($request, roleId: 3);

        auth()->login($user);

        return match ((int) $user->role_id) {
            1 => redirect()->route('login.show')->with('success', 'Account registered successfully.'),
            2 => view('employee.create-employee'),
            default => redirect('/view-jobs')->with('success', 'Account registered successfully.'),
        };
    }

    /**
     * Handle AJAX / Async registration (e.g. after OTP validation).
     */
    public function registerUser(RegisterRequest $request)
    {
        try {
            $user = $this->storeUserAndApplicant($request, roleId: 3);

            auth()->login($user);

            return response()->json(['result' => 1, 'message' => 'Registration successful!']);
        } catch (\Throwable $e) {
            return response()->json(['result' => 0, 'message' => 'Registration failed. Please try again.'], 500);
        }
    }

    /**
     * Send email verification OTP safely.
     */
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

        // Save OTP temporarily in session for verification checks if needed
        session(['otp' => $otp, 'otp_email' => $toEmail]);

        Mail::send('mail.otp', ['otp' => $otp, 'to_name' => $toName], function ($message) use ($toName, $toEmail) {
            $message->to($toEmail, $toName)
                    ->subject('Your OTP Verification Code');
            $message->from('aei.rms.system@gmail.com', 'AEI - RMS');
        });

        // NOTE: We do NOT return the raw OTP in the response JSON for security reasons.
        return response()->json(['result' => 1, 'message' => 'OTP sent successfully to your email.']);
    }

    /**
     * Handle applicant profile updates.
     */
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
            $fileName = time() . '_' . $request->file('myfile')->getClientOriginalName();
            $request->file('myfile')->storeAs('uploads', $fileName, 'public');
            $data['file_attachment'] = $fileName;
        }

        Applicant::where('applicant_id', auth()->id())->update($data);

        return response()->json([
            'result' => 1,
            'fileName' => $data['file_attachment'] ?? null
        ]);
    }

    /**
     * Private helper to handle database transactions cleanly.
     */
    private function storeUserAndApplicant(RegisterRequest $request, int $roleId): User
    {
        return DB::transaction(function () use ($request, $roleId) {
            $user = User::create([
                'name' => trim("{$request->firstname} {$request->middlename} {$request->lastname}"),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $roleId,
            ]);

            Applicant::create([
                'applicant_id' => $user->id,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'middle_name' => $request->middlename,
                'email_address' => $request->email,
                'birth_date' => $request->birth_date ?? null,
                'remarks' => 'Pending',
            ]);

            return $user;
        });
    }

    /**
     * Verify the entered OTP against the session.
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $sessionOtp = session('otp');

        if ($sessionOtp && (string) $sessionOtp === (string) $request->otp) {
            // OTP is correct, now register the user right here securely!
            try {
                $user = $this->storeUserAndApplicant($request, roleId: 3);
                auth()->login($user);

                // Clear the session OTP
                session()->forget(['otp', 'otp_email']);

                return response()->json(['result' => 1, 'message' => 'Registration successful!']);
            } catch (\Throwable $e) {
                return response()->json(['result' => 0, 'message' => 'Registration failed.']);
            }
        }

        return response()->json(['result' => 0, 'message' => 'Invalid OTP!']);
    }
}
