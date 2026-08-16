<?php

use App\Http\Controllers\Admin\ChartJSController;
use App\Http\Controllers\Admin\EmployerRemarksController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\General\ContactController;
use App\Http\Controllers\General\HomeController;
use App\Http\Controllers\Job\ApplyController;
use App\Http\Controllers\Job\VacancyController;
use App\Http\Controllers\Media\ImageController;
use App\Http\Controllers\Media\UploadController;
use App\Http\Controllers\User\EducationalBackgroundController;
use App\Http\Controllers\User\ExpController;
use App\Http\Controllers\User\UserController;
use App\Http\Livewire\Applicants;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'prevent-back-history'], function () {

    /*
    |--------------------------------------------------------------------------
    | Public & General Front-End Routes
    |--------------------------------------------------------------------------
    */
    Route::view('/', 'pages.front-page')->name('front-page');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/contacts', 'pages.contacts')->name('contacts');
    Route::view('/term', 'pages.terms')->name('term');
    Route::view('/view-jobs', 'jobs.index')->name('view-jobs');
    Route::view('/job-details', 'pages.job-details')->name('job-details');
    Route::view('/job_list', 'pages.job-list')->name('job-list');

    Route::get('/getVacancies', [VacancyController::class, 'getVacancies'])->name('vacancies.active');
    Route::get('/getBestApplicant', [VacancyController::class, 'getBestApplicant']);

    // Contact Form
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'mailContactForm'])->name('contact.mailContactForm');

    // Password Reset Routes
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    /*
    |--------------------------------------------------------------------------
    | Guest Only Routes (Login, Register, Social Auth)
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {
        // Registration Routes
        Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

        // AJAX & OTP Endpoints
        Route::post('/send-otp', [RegisterController::class, 'sendOTP'])->name('sendOTP');
        Route::post('/register-user', [RegisterController::class, 'registerUser'])->name('registerUser');

        // Login Routes
        Route::get('/login', [LoginController::class, 'show'])->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])
            ->middleware('throttle:login')
            ->name('login.perform');

        // Google Social Login
        Route::get('/login/google', [GoogleLoginController::class, 'redirect'])->name('login.google-redirect');
        Route::get('/login/google/callback', [GoogleLoginController::class, 'callback'])->name('login.google-callback');
        // Verify OTP
        Route::post('/verify-otp', [RegisterController::class, 'verifyOTP'])->name('verifyOTP');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['middleware' => ['auth']], function () {

        // Home & Dashboards
        Route::get('/home-index', [HomeController::class, 'index'])->name('home.index');
        Route::view('/home', 'home.index')->name('home');
        Route::view('/applicant-Jobs', 'applicant.dashboard')->name('applicant-dashboard');
        Route::resource('dashboard', ChartJSController::class);

        // Vacancy & Applications
        Route::resource('/vacancy', VacancyController::class)->names('vacancy');
        Route::view('/success', 'vacancy.success')->name('success');
        Route::get('/status-update/{id}', [VacancyController::class, 'updateStatus'])->name('status-update');

        Route::resource('/apply', ApplyController::class)->names('apply');
        Route::get('/get_applicants', [ApplyController::class, 'get_applicants']);
        Route::get('/application-form/{id}', [ApplyController::class, 'get']);
        Route::get('/applyJob', [ApplyController::class, 'applyJob']);
        Route::post('/applicant.store', [Applicants::class, 'store'])->name('applicant.store');

        // User & Profiles
        Route::view('/account-profile', 'applicant.accounts')->name('account-profile');
        Route::view('/edit_applicant_account', 'applicant.edit-account')->name('edit_applicant_account');
        Route::view('/employer-profile', 'employer.employer-profile')->name('employer-profile');
        Route::post('/employer-profile', [CompanyController::class, 'updateEmployerProfile'])->name('employer-profile.update');
        Route::view('/profile', 'applicant.partials.profile')->name('profile');
        Route::post('/edit_profile', [RegisterController::class, 'edit_profile'])->name('edit_profile');
        Route::view('/show-employer', 'employer.show-employer')->name('show-employer');
        Route::view('/create-employer', 'employer.create-employer')->name('create-employer');

        // Company Management
        Route::resource('/company', CompanyController::class)->names('company');

        // Applicant Forms & Tables (Livewire & Views)
        Route::view('/applicant-create', 'livewire.applicant-create')->name('applicant-create');
        Route::view('/applicant-update', 'livewire.applicant-update')->name('applicant-update');
        Route::view('/applicant-application-form', 'applicant.application-form')->name('applicant-application-form');
        Route::view('/applicant-table', 'livewire.applicant-table')->name('applicant-table');
        Route::view('/employer-applicant-table-record', 'employer.employer-applicant-table-record')->name('employer-applicant-table-record');
        Route::get('/download/{id}', [Applicants::class, 'download']);

        // Educational Background
        Route::resource('educational_background', EducationalBackgroundController::class);
        Route::get('/getEB', [EducationalBackgroundController::class, 'getEB']);
        Route::post('/saveEB', [EducationalBackgroundController::class, 'store']);
        Route::get('/getEBById', [EducationalBackgroundController::class, 'getEBById']);
        Route::post('/deleteEB', [EducationalBackgroundController::class, 'deleteEB']);

        // Job Experience
        Route::resource('job-experience', ExpController::class);
        Route::get('/getWE', [ExpController::class, 'getWE']);
        Route::post('/saveWE', [ExpController::class, 'saveWE']);
        Route::get('/getWEById', [ExpController::class, 'getWEById']);
        Route::post('/deleteWE', [ExpController::class, 'deleteWE']);

        // Employer Remarks & Images/Uploads
        Route::resource('employer_remarks', EmployerRemarksController::class);
        Route::resource('image', ImageController::class);
        Route::view('/media/image-form', 'media.image-form')->name('media.image-form');
        Route::get('/image-upload', [ImageController::class, 'index'])->name('image.form');
        Route::post('/upload-image', [ImageController::class, 'store']);

        Route::view('/UploadFile', 'uploads.create')->name('UploadFile');
        Route::post('save_file', [UploadController::class, 'myFileSave'])->name('save-file');

        // Reports & Misc Utilities
        Route::get('/generate-reports', [ApplyController::class, 'get_applicants'])->name('reports.index');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users-send-email', [UserController::class, 'sendEmail'])->name('ajax.send.email');

        // Logout
        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    });

});
