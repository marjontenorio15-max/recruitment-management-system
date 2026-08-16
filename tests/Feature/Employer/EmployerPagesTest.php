<?php

namespace Tests\Feature\Employer;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployerPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_employer_can_access_all_employer_pages(): void
    {
        $employer = User::factory()->create(['role_id' => 2]);
        Company::create([
            'company_id' => $employer->id,
            'company_name' => 'TechCorp Philippines',
            'address' => 'Laguna Technopark, Biñan',
            'contact_no' => '09123456789',
        ]);

        $this->actingAs($employer)->get(route('home'))->assertOk()->assertSee('Employer Overview');
        $this->actingAs($employer)->get(route('employer-profile'))->assertOk()->assertSee('TechCorp Philippines');
        $this->actingAs($employer)->get(route('vacancy.index'))->assertOk()->assertSee('Vacancies');
        $this->actingAs($employer)->get(route('employer-applicant-table-record'))->assertOk()->assertSee('Applicant Submissions');
        $this->actingAs($employer)->get(route('reports.index'))->assertOk()->assertSee('Applicant Reports');
        $this->actingAs($employer)->get(route('company.index'))->assertOk()->assertSee('Registered Companies');
    }
}
