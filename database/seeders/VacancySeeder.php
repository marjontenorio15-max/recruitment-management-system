<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    public function run(): void
    {
        $employer = User::where('email', 'employer@example.com')->firstOrFail();
        $company = Company::where('company_id', $employer->id)->firstOrFail();

        foreach ([
            [
                'title' => 'Junior Web Developer',
                'no_of_employee' => 2,
                'salary' => 'PHP 30,000 - PHP 40,000',
                'sex' => 'Any',
                'degree' => 'Bachelor of Science in Information Technology',
                'work_exp' => '0-2 years',
                'job_desc' => 'Build and maintain Laravel web applications.',
                'location' => 'Makati City',
            ],
            [
                'title' => 'Human Resources Assistant',
                'no_of_employee' => 1,
                'salary' => 'PHP 22,000 - PHP 28,000',
                'sex' => 'Any',
                'degree' => 'Bachelor degree in Human Resources or related field',
                'work_exp' => '1 year',
                'job_desc' => 'Support recruitment and employee records management.',
                'location' => 'Makati City',
            ],
        ] as $vacancy) {
            Vacancy::updateOrCreate(
                ['title' => $vacancy['title'], 'company_id' => $company->company_id],
                [
                    ...$vacancy,
                    'created_by' => (string) $employer->id,
                    'company_id' => $company->company_id,
                    'status' => true,
                ]
            );
        }
    }
}
