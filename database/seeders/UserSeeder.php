<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'firstname' => 'Admin',
                'lastname' => 'User',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'password123',
                'role_id' => 1,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'employer@example.com'],
            [
                'name' => 'Employer User',
                'firstname' => 'Employer',
                'lastname' => 'Company',
                'username' => 'employer',
                'email' => 'employer@example.com',
                'password' => 'password123',
                'role_id' => 2,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'applicant@example.com'],
            [
                'name' => 'Applicant User',
                'firstname' => 'Applicant',
                'lastname' => 'Job Seeker',
                'username' => 'applicant',
                'email' => 'applicant@example.com',
                'password' => 'password123',
                'role_id' => 3,
                'email_verified_at' => now(),
            ]
        );
    }
}
