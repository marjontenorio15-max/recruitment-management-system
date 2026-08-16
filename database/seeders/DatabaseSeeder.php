<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            VacancySeeder::class,
            ApplicantSeeder::class,
            ApplicationSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            EmployerRemarksSeeder::class,
            ImageSeeder::class,
            EmployerSeeder::class,
        ]);
    }
}
