<?php

namespace Tests\Feature\Auth;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
        RateLimiter::clear('test-user|127.0.0.1');
    }

    public function test_login_page_does_not_require_a_browser_only_captcha(): void
    {
        $response = $this->get(route('login.show'));

        $response
            ->assertOk()
            ->assertSee('Sign In')
            ->assertDontSee('cpatchaTextBox')
            ->assertDontSee('createCaptcha');
    }

    public function test_login_attempts_are_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('login.perform'), ['username' => 'test-user'])
                ->assertRedirect();
        }

        $this->post(route('login.perform'), ['username' => 'test-user'])
            ->assertTooManyRequests();
    }

    public function test_seeded_user_can_log_in_with_a_username(): void
    {
        $response = $this->post(route('login.perform'), [
            'username' => 'admin',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_seeded_user_can_log_in_with_an_email_address(): void
    {
        $response = $this->post(route('login.perform'), [
            'username' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
}
