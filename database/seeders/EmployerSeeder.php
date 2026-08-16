<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('company_name', 'Acme Recruitment Solutions')->firstOrFail();

        Employee::updateOrCreate(
            ['email' => 'employer-record@example.com'],
            [
                'company_id' => $company->id,
                'company_name' => $company->company_name,
                'username' => 'acme-employer',
                'password' => 'password123',
                'contact_no' => 281234567,
                'email_verified_at' => now(),
            ]
        );
    }
}
