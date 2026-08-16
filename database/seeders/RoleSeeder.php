<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Admin',
                'description' => 'Administrator role',
            ],
        );

        Role::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Employer',
                'description' => 'Employer/Company role',
            ],
        );

        Role::updateOrCreate(
            ['id' => 3],
            [
                'name' => 'Applicant',
                'description' => 'Job applicant role',
            ],
        );
    }
}
