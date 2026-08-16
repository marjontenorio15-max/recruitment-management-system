<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Apply;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $applicant = Applicant::where('email_address', 'applicant@example.com')->firstOrFail();
        $vacancy = Vacancy::where('title', 'Junior Web Developer')->firstOrFail();

        Apply::updateOrCreate(
            ['job_id' => $vacancy->id, 'applicant_id' => $applicant->applicant_id],
            ['remarks' => 'Pending', 'description' => 'Sample application for review.']
        );
    }
}
