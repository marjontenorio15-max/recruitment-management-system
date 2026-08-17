<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Company;
use App\Models\User;
use App\Models\Vacancy;
use Carbon\Carbon;

class ChartJSController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;

        // Key Metric Totals
        $totalJobs = Vacancy::count();
        $totalApplies = Apply::count();
        $totalUsers = User::count();
        $totalCompanies = Company::count();
        $applicantsCount = User::where('role_id', 3)->count();
        $employersCount = User::where('role_id', 2)->count();

        // 12 Months Data Series for Charts
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlyUsers = [];
        $monthlyApplies = [];
        $monthlyVacancies = [];

        for ($m = 1; $m <= 12; $m++) {
            $monthlyUsers[] = User::whereYear('created_at', $currentYear)->whereMonth('created_at', $m)->count();
            $monthlyApplies[] = Apply::whereYear('created_at', $currentYear)->whereMonth('created_at', $m)->count();
            $monthlyVacancies[] = Vacancy::whereYear('created_at', $currentYear)->whereMonth('created_at', $m)->count();
        }

        // Recent Applications (Latest 5)
        $recentApplies = Apply::query()
            ->join('tbl_job_list', 'apply.job_id', '=', 'tbl_job_list.id')
            ->join('applicants', 'apply.applicant_id', '=', 'applicants.applicant_id')
            ->leftJoin('companies', 'tbl_job_list.company_id', '=', 'companies.company_id')
            ->select(
                'apply.id',
                'apply.remarks',
                'apply.created_at',
                'tbl_job_list.title',
                'companies.company_name',
                'applicants.first_name',
                'applicants.last_name'
            )
            ->latest('apply.created_at')
            ->take(5)
            ->get();

        // Recent Vacancies (Latest 5)
        $recentVacancies = Vacancy::query()
            ->leftJoin('companies', 'tbl_job_list.company_id', '=', 'companies.company_id')
            ->select('tbl_job_list.*', 'companies.company_name')
            ->latest('tbl_job_list.created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalJobs',
            'totalApplies',
            'totalUsers',
            'totalCompanies',
            'applicantsCount',
            'employersCount',
            'months',
            'monthlyUsers',
            'monthlyApplies',
            'monthlyVacancies',
            'recentApplies',
            'recentVacancies'
        ));
    }
}
