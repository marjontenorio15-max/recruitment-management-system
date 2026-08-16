<?php

namespace Tests\Feature\Account;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_authenticated_applicant_can_access_account_profile(): void
    {
        $applicantUser = User::factory()->create([
            'role_id' => 3,
        ]);

        Applicant::create([
            'applicant_id' => $applicantUser->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email_address' => $applicantUser->email,
            'remarks' => 'Pending',
        ]);

        $response = $this->actingAs($applicantUser)->get(route('account-profile'));

        $response->assertOk();
        $response->assertSee('Personal Information');
        $response->assertSee('Educational Background');
    }
}
