<?php

namespace Tests\Feature\Admin;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_admin_can_access_all_admin_pages(): void
    {
        $admin = User::factory()->create(['role_id' => 1]);

        $this->actingAs($admin)->get(route('dashboard.index'))->assertOk()->assertSee('Executive Administrator Console');
        $this->actingAs($admin)->get(route('vacancy.index'))->assertOk()->assertSee('Vacancies');
        $this->actingAs($admin)->get(route('vacancy.create'))->assertOk()->assertSee('Add New Jobs');
        $this->actingAs($admin)->get(route('reports.index'))->assertOk()->assertSee('Applicant Reports');
        $this->actingAs($admin)->get(route('users.index'))->assertOk()->assertSee('User Directory');
        $this->actingAs($admin)->get(route('company.index'))->assertOk()->assertSee('Registered Companies');
        $this->actingAs($admin)->get(route('apply.index'))->assertOk()->assertSee('Applicant Submissions');
    }
}
