<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChartJSController extends Controller
{
    public function index()
    {
        //        $users = DB::table('users')->select("id as counts",
        //           "created_at as month_name")
        //            ->whereYear('created_at', date('Y'))
        //            ->groupBy('created_at')
        //            ->get('count', 'month_name');
        $users = DB::table('users')
            ->select(DB::raw('COUNT(*) as count'), DB::raw('DAY(created_at) as month_name'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('DAY(created_at)'))
            ->pluck('count', 'month_name');

        $labels = $users->keys();
        $data = $users->values();

        // for apply
        $visitors = Apply::select('created_at', 'job_id', 'applicant_id')->get();

        $result[] = ['Dates', 'job', 'applicant'];
        foreach ($visitors as $key => $value) {
            $result[++$key] = [$value->created_at, (int) $value->job_id, (int) $value->applicant_id];
        }

        //        for baruser
        $year = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
            'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = User::where(DB::raw("DATE_FORMAT(created_at, '%M')"), $value)->count();
        }

        return view('admin.dashboard', compact(
            'labels', 'data', 'result',
        ))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('user', json_encode($user, JSON_NUMERIC_CHECK));

    }
}
