<?php

namespace Tests\Feature\Auth;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->seed();
    }

    public function test_registration_page_can_be_rendered(): void
    {
        $response = $this->get(route('register.show'));

        $response->assertOk();
    }

    public function test_new_user_can_register(): void
    {
        $response = $this->post(route('register.perform'), [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'username' => 'johndoe',
        ]);
        $this->assertDatabaseHas('applicants', [
            'email_address' => 'john@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    public function test_newly_registered_user_can_subsequently_log_in(): void
    {
        $this->post(route('register.perform'), [
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'username' => 'janedoe',
            'email' => 'jane@example.com',
            'password' => 'mypassword123',
            'password_confirmation' => 'mypassword123',
        ]);

        Auth::logout();

        $response = $this->post(route('login.perform'), [
            'username' => 'janedoe',
            'password' => 'mypassword123',
        ]);

        $this->assertAuthenticated();
    }
}
