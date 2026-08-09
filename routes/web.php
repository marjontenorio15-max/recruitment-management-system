<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\Employer_RemarksController;
use App\Http\Controllers\ExpController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Applicants;
use App\Mail\SendTestMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/download/{id}', [Applicants::class, 'download']);
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users-send-email', [UserController::class, 'sendEmail'])->name('ajax.send.email');

Route::get('/send-mail',function(){

//    $app = DB::table('applicants')->get();
//    $users = Applicants::whereIn("id", $request->id)->get();
    $data = [
        'name'=> auth()->user()->name,
        'email'=> auth()->user()->email
    ];
//    foreach ($users as $key => $user) {
//        Mail::to($user->email)->send(new UserEmail($user));
//    }

    Mail::to('admin@gmail.com')->send(new SendTestMail($data));

    return "Mail Sent Successfully!!";
});

Route::group(['middleware' => 'prevent-back-history'],function(){


    Route::group(['namespace' => 'App\Http\Controllers'], function() {
        /**
         * Home Routes
         */
        Route::get('/home-index', 'HomeController@index')->name('home.index');
        Route::view('/home', 'home.index')->name('home');
    //    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::view('/', 'pages.front-page')->name('front-page');
        Route::view('/about', 'pages.about')->name('about');
        Route::view('/contacts', 'pages.contacts')->name('contacts');
        Route::view('/term', 'pages.terms')->name('term');
        Route::view('/view-jobs', 'view_jobs.view-jobs')->name('view-jobs');



        Route::view('/job-details', 'pages.job-details')->name('job-details');
        Route::resource('/vacancy', VacancyController::class)->names('vacancy');
        Route::get('/getBestApplicant', [VacancyController::class,'getBestApplicant']);
        Route::view('/applicant-create', 'livewire.applicant-create')->name('applicant-create');

        Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

        //charts with report pdf
        //contact us
        Route::get('/contact', [ContactController::class,'show'])->name('contact.show');
        Route::post('/contact', [ContactController::class, 'mailContactForm'])->name('contact.mailContactForm');

        Route::group(['middleware' => ['guest']], function () {
            /**
             * Register Routes
             */
            Route::get('/register', 'RegisterController@show')->name('register.show');
            Route::post('/register', 'RegisterController@register')->name('register.perform');
            Route::post('/sendOTP', 'RegisterController@sendOTP')->name('sendOTP');
            Route::post('/registerUser', 'RegisterController@registerUser')->name('registerUser');

            /**
             * Login Routes
             */
            Route::get('/login', 'LoginController@show')->name('login.show');
            Route::post('/login', 'LoginController@login')->name('login.perform');

            /* Google Social Login */
            Route::get('/login/google', 'GoogleLoginController@redirect')->name('login.google-redirect');
            Route::get('/login/google/callback', 'GoogleLoginController@callback')->name('login.google-callback');
        });

        Route::get('/getVacancies', [VacancyController::class,'getVacancies']);
        Route::post('/applicant.store', [Applicants::class,'store'])->name('applicant.store');

        Route::group(['middleware' => ['auth']], function () {


            Route::get('/success{id}', [VacancyController::class,'success']);

            Route::View('/success', 'vacancy.success')->name('success');

            Route::view('/applicant-update', 'livewire.applicant-update')->name('applicant-update');

            Route::view('/applicant-application-form', 'applicant-application-form')->name('applicant-application-form');

            Route::resource('/company', CompanyController::class)->names('company');

            Route::view('/applicant-Jobs', 'applicant.dashboard')->name('applicant-dashboard');

//            Route::view('/manage-user', 'manage_user.manage-user')->name('manage-user');

            Route::view('/account-profile', 'applicant.accounts')->name('account-profile');

            Route::controller(ImageController::class)->group(function(){
                Route::get('/image-upload', 'index')->name('image.form');
                Route::post('/upload-image', 'store')->name('image.store');
            });

            Route::view('/image-form', 'image-form')->name('image-form');

            Route::view('/edit_applicant_account', 'applicant-account.edit_applicant_account')->name('edit_applicant_account');

            Route::view('/generate-reports', 'generate-reports')->name('generate-reports');

            Route::get('/generate-reports', [ApplyController::class, 'get_applicants'])->name('generate-reports');

            Route::view('/employer-profile', 'employer.employer-profile')->name('employer-profile');

            Route::resource('/apply', ApplyController::class)->names('apply');


            Route::view('/profile', 'profile')->name('profile');
            Route::post('/edit_profile', [RegisterController::class,'edit_profile']);

            Route::view('/applicant-table', 'livewire.applicant-table')->name('applicant-table');

            Route::view('/employer-applicant-table-record', 'employer.employer-applicant-table-record')->name('employer-applicant-table-record');

            Route::resource('image', ImageController::class);


            Route::get('/application-form/{id}', [ApplyController::class, 'get']);
            Route::get('/applyJob', [ApplyController::class, 'applyJob']);

            Route::resource('employer_remarks', Employer_RemarksController::class);

            //education background | degree
            Route::resource('educational_background', EducationalBackgroundController::class);
            Route::get('/getEB', [EducationalBackgroundController::class,'getEB']);
            Route::post('/saveEB', [EducationalBackgroundController::class,'store']);
            Route::get('/getEBById', [EducationalBackgroundController::class,'getEBById']);
            Route::post('/deleteEB', [EducationalBackgroundController::class,'deleteEB']);

            //charts
            Route::resource('dashboard', ChartJSController::class);

            //Experience
            Route::resource('job-experience', ExpController::class);
            Route::get('/getWE', [ExpController::class,'getWE']);
            Route::post('/saveWE', [ExpController::class,'saveWE']);
            Route::get('/getWEById', [ExpController::class,'getWEById']);
            Route::post('/deleteWE', [ExpController::class,'deleteWE']);

            Route::get('/status-update/{id}', [VacancyController::class , 'updateStatus'])->name('status-update');


            Route::get('/employer', 'LoginController@show')->name('employer.show');
            Route::post('/employer', 'LoginController@login')->name('employer.perform');

            Route::get('/employer', 'RegisterController@show')->name('employer.show');
            Route::post('/employer', 'RegisterController@employer')->name('employer.perform');

            /**
             * Logout Routes
             */
            Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        });

    //    Route::get('/employer', 'LoginController@show')->name('employer.show');
    //    Route::post('/employer', 'LoginController@login')->name('employer.perform');
    //
    //    Route::get('/employer', 'RegisterController@show')->name('employer.show');
    //    Route::post('/employer', 'RegisterController@employer')->name('employer.perform');



        Route::view('/page', 'pages.page')->name('page');
        Route::view('/page2', 'pages.page-2')->name('page-2');
        Route::view('/page3', 'pages.page-3')->name('page-3');
        Route::view('/page4', 'pages.page-4')->name('page-4');
        Route::view('/UploadFile', 'UploadFile')->name('UploadFile');


    //    Route::view('/download/{id}', 'UploadFile')->name('UploadFile');

        Route::post('save_file', [UploadController::class,'myFileSave'])->name('save-file');
        Route::view('/job_list', 'pages.job_list')->name('job-list');
        Route::view('/create-employer', 'employer.create-employer')->name('create-employer');

    //    Route::view('/company', 'company.index')->name('company');

        //    Route::view('/index', 'vacancy.index')->name('index');

    //    Route::resource('')

        Route::view('/show-employer', 'employer.show-employer')->name('show-employer');

    //    Route::view('/register-applicant', 'auth.register')->name('register-applicant');

        //Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

        //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //    Route::get('/edit/{id}', [\App\Http\Controllers\RemarksController::class, 'edit']);
    //
    //    Route::get('/update/{id}', [\App\Http\Controllers\RemarksController::class, 'update']);

    //    Route::get('/delete/{id}', [\App\Http\Controllers\RemarksController::class, 'delete']);

    //    Route::view('/employer_remarks', view('employer_remarks.index'))->name('employer_remarks');

    //    Route::get('/remarks/{id}', [\App\Http\Controllers\RemarksController::class, 'remarks']);

    });
});
