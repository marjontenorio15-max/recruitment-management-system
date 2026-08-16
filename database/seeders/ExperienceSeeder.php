<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Exp;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $applicant = Applicant::where('email_address', 'applicant@example.com')->firstOrFail();

        Exp::updateOrCreate(
            ['applicant_id' => $applicant->applicant_id, 'job_title' => 'IT Support Intern'],
            [
                'company_name' => 'Sample Technology Inc.',
                'period_employed' => '2020-06-01',
                'achievements' => 'Assisted with internal tools and end-user support.',
            ]
        );
    }
}
