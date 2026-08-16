<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'applicant@example.com')->firstOrFail();

        Applicant::updateOrCreate(
            ['applicant_id' => (string) $user->id],
            [
                'first_name' => 'Applicant', 'last_name' => 'Job Seeker', 'middle_name' => 'Sample',
                'address' => '45 Sample Street', 'city' => 'Quezon City', 'state' => 'Metro Manila', 'zipcode' => '1100',
                'sex' => 'Prefer not to say', 'civil_status' => 'Single', 'birth_date' => '1998-06-15',
                'birth_place' => 'Quezon City', 'age' => 28, 'email_address' => $user->email,
                'contact_no' => 9171234567, 'degree' => 'Bachelor of Science in Information Technology',
                'file_attachment' => '', 'remarks' => 'Pending',
            ]
        );
    }
}
