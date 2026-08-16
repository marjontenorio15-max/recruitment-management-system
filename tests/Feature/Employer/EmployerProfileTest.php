<?php

namespace Tests\Feature\Employer;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployerProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_employer_can_view_employer_profile(): void
    {
        $employer = User::factory()->create(['role_id' => 2]);
        Company::create([
            'company_id' => $employer->id,
            'company_name' => 'Acme Corp',
            'address' => '123 Business Way',
            'contact_no' => '09123456789',
        ]);

        $response = $this->actingAs($employer)->get(route('employer-profile'));

        $response->assertOk();
        $response->assertSee('Acme Corp');
        $response->assertSee('Total Job Openings');
    }

    public function test_employer_can_update_employer_profile(): void
    {
        $employer = User::factory()->create(['role_id' => 2]);

        $response = $this->actingAs($employer)->post(route('employer-profile.update'), [
            'company_name' => 'Tech Innovations Inc',
            'name' => 'HR Manager',
            'contact_no' => '09988776655',
            'address' => '456 Tech Park, Cebu City',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('companies', [
            'company_id' => $employer->id,
            'company_name' => 'Tech Innovations Inc',
            'address' => '456 Tech Park, Cebu City',
        ]);
    }
}
