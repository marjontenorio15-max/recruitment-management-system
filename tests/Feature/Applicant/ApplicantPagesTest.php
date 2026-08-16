<?php

namespace Tests\Feature\Applicant;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Applicant;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicantPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_applicant_can_access_all_applicant_pages(): void
    {
        $applicant = User::factory()->create(['role_id' => 3]);
        Applicant::create([
            'applicant_id' => $applicant->id,
            'first_name' => 'Maria',
            'last_name' => 'Santos',
            'email_address' => $applicant->email,
            'remarks' => 'Pending',
        ]);

        $this->actingAs($applicant)->get(route('front-page'))->assertOk()->assertSee('Career');
        $this->actingAs($applicant)->get(route('view-jobs'))->assertOk()->assertSee('Find Your Dream Job Today');
        $this->actingAs($applicant)->get(route('applicant-dashboard'))->assertOk()->assertSee('Applied Jobs History');
        $this->actingAs($applicant)->get(route('account-profile'))->assertOk()->assertSee('Personal Information');
        $this->actingAs($applicant)->get(route('educational_background.index'))->assertOk()->assertSee('Educational Background');
        $this->actingAs($applicant)->get(route('job-experience.index'))->assertOk()->assertSee('Work Experience');
    }

    public function test_applicant_can_apply_for_job(): void
    {
        $employer = User::factory()->create(['role_id' => 2]);
        $applicant = User::factory()->create(['role_id' => 3]);

        $vacancy = Vacancy::create([
            'title' => 'Software QA Engineer',
            'company_id' => $employer->id,
            'created_by' => $employer->id,
            'no_of_employee' => 1,
            'salary' => '45000',
            'sex' => 'Any',
            'degree' => 'BS IT',
            'work_exp' => '1 year',
            'job_desc' => 'Testing software systems',
            'location' => 'Laguna',
            'status' => 1,
        ]);

        $response = $this->actingAs($applicant)->get('/applyJob?job_id=' . $vacancy->id);

        $response->assertOk();
        $response->assertJson(['result' => 1]);

        $this->assertDatabaseHas('apply', [
            'job_id' => $vacancy->id,
            'applicant_id' => $applicant->id,
            'remarks' => 'Pending',
        ]);
    }
}
