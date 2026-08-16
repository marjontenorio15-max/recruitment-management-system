<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $employer = User::where('email', 'employer@example.com')->firstOrFail();

        Company::updateOrCreate(
            ['company_id' => $employer->id],
            [
                'company_name' => 'Acme Recruitment Solutions',
                'address' => '123 Ayala Avenue, Makati City',
                'contact_no' => 281234567,
            ]
        );
    }
}
