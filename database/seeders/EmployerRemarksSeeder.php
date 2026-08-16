<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Employer_Remarks;
use Illuminate\Database\Seeder;

class EmployerRemarksSeeder extends Seeder
{
    public function run(): void
    {
        $applicant = Applicant::where('email_address', 'applicant@example.com')->firstOrFail();

        Employer_Remarks::updateOrCreate(
            ['applicant_id' => $applicant->applicant_id],
            ['remarks' => 'Initial application received and ready for review.']
        );
    }
}
