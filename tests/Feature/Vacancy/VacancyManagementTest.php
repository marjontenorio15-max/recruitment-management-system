<?php

namespace Tests\Feature\Vacancy;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacancyManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_admin_can_view_all_vacancies(): void
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $employer = User::factory()->create(['role_id' => 2]);

        Vacancy::create([
            'title' => 'Admin Job',
            'company_id' => $admin->id,
            'created_by' => $admin->id,
            'no_of_employee' => 2,
            'salary' => '35000',
            'sex' => 'Any',
            'degree' => 'BS Computer Science',
            'work_exp' => '2 years',
            'job_desc' => 'Admin job description',
            'location' => 'Metro Manila',
            'status' => 1,
        ]);

        Vacancy::create([
            'title' => 'Employer Job',
            'company_id' => $employer->id,
            'created_by' => $employer->id,
            'no_of_employee' => 1,
            'salary' => '25000',
            'sex' => 'Any',
            'degree' => 'BS Information Technology',
            'work_exp' => '1 year',
            'job_desc' => 'Employer job description',
            'location' => 'Cebu',
            'status' => 1,
        ]);

        $response = $this->actingAs($admin)->get(route('vacancy.index'));

        $response->assertOk();
        $response->assertSee('Admin Job');
        $response->assertSee('Employer Job');
    }

    public function test_employer_only_views_their_company_vacancies(): void
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $employer1 = User::factory()->create(['role_id' => 2]);
        $employer2 = User::factory()->create(['role_id' => 2]);

        Vacancy::create([
            'title' => 'Employer 1 Position',
            'company_id' => $employer1->id,
            'created_by' => $employer1->id,
            'no_of_employee' => 2,
            'salary' => '30000',
            'sex' => 'Any',
            'degree' => 'BS',
            'work_exp' => '2 years',
            'job_desc' => 'Desc 1',
            'location' => 'Manila',
            'status' => 1,
        ]);

        Vacancy::create([
            'title' => 'Employer 2 Position',
            'company_id' => $employer2->id,
            'created_by' => $employer2->id,
            'no_of_employee' => 1,
            'salary' => '40000',
            'sex' => 'Any',
            'degree' => 'BS',
            'work_exp' => '3 years',
            'job_desc' => 'Desc 2',
            'location' => 'Davao',
            'status' => 1,
        ]);

        $response = $this->actingAs($employer1)->get(route('vacancy.index'));

        $response->assertOk();
        $response->assertSee('Employer 1 Position');
        $response->assertDontSee('Employer 2 Position');
    }
}
