<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Degree;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $applicant = Applicant::where('email_address', 'applicant@example.com')->firstOrFail();

        Degree::updateOrCreate(
            ['applicant_id' => $applicant->applicant_id, 'school_name' => 'Sample State University'],
            [
                'school_location' => 'Quezon City',
                'degree' => 'Bachelor of Science in Information Technology',
                'field_of_study' => 'Information Technology',
                'year_graduate' => '2020',
                'month_graduate' => 'June',
            ]
        );
    }
}
