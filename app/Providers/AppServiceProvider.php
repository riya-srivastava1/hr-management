<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\ClockRecord;
use Illuminate\Http\Request;
use App\Models\Leave_request;
use App\Models\EmployeeRecord;
use App\Models\Mark_attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Reimbursement_request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);

        View::composer('layouts.includes.header', function ($view) {
            $isClockedIn = ClockRecord::where('user_id', auth()->id())
                ->where('date', today()->format('Y-m-d'))
                ->first();

            $currentMonth = Carbon::now()->format('m');
            $employees = EmployeeRecord::whereMonth('date_of_birth', $currentMonth)->get();

            $currentMonth = now()->format('m');
            $employees = EmployeeRecord::whereRaw("MONTH(date_of_birth) = ? AND (DAY(date_of_birth) > ? OR DAY(date_of_birth) = ?)", [$currentMonth, now()->day, now()->day])
                ->get();


            $leaves = Leave_request::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();
            $reimburs = Reimbursement_request::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();
            $markAttendances = Mark_attendance::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();

            //Notification requests leaves
            if (Auth()->user()->role == 0) {
                $repoMan = EmployeeRecord::where('reporting_manager', Auth()->user()->name)->get('employee_name');
                $leavescount = Leave_request::whereIn('requested_by', $repoMan)->where('status', 'Pending')->count();
            } else {
                $leavescount = Leave_request::where('status', 'Pending')->count();
            }

            if (Auth()->user()->role == 0) {
                $repoMan = EmployeeRecord::where('reporting_manager', Auth()->user()->name)->get('employee_name');
                $reimburscount = Reimbursement_request::whereIn('requested_by', $repoMan)->where('status', 'Pending')->count();
            } else {
                $reimburscount = Reimbursement_request::where('status', 'Pending')->count();
            }

            if (Auth()->user()->role == 0) {
                $repoMan = EmployeeRecord::where('reporting_manager', Auth()->user()->name)->get('employee_name');
                $markAttendancescount = Mark_attendance::whereIn('requested_by', $repoMan)->where('status', 'Pending')->count();
            } else {
                $markAttendancescount = Mark_attendance::where('status', 'Pending')->count();
            }
            $total = $leavescount + $reimburscount + $markAttendancescount;
            // ! Notification request leaves end

            $empleaves = Leave_request::where('requested_by', Auth::user()->name)->where('status', 'approved')->orWhere('status', 'rejected')->get();
            $reimbursemps = Reimbursement_request::where('requested_by', Auth::user()->name)->where('status', 'approved')->orWhere('status', 'rejected')->get();
            $markAttendmps = Mark_attendance::where('requested_by', Auth::user()->name)->where('status', 'approved')->orWhere('status', 'rejected')->get();

            $empleavecount = Leave_request::where('requested_by', Auth::user()->name)->where('status', 'approved')->orWhere('status', 'rejected')->count();
            $reimbursempcount = Reimbursement_request::where('requested_by', Auth::user()->name)->where('status', 'approved')->orWhere('status', 'rejected')->count();
            $markAttendmpcount = Mark_attendance::where('requested_by', Auth::user()->name)->where('status', 'approved')->orWhere('status', 'rejected')->count();
            $totalcount = $empleavecount + $reimbursempcount + $markAttendmpcount;
            $view->with([
                'isClockedIn' => $isClockedIn,
                'employees' => $employees,
                'leaves' => $leaves,
                'reimburs' => $reimburs,
                'markAttendances' => $markAttendances,
                'empleaves' => $empleaves,
                'reimbursemps' => $reimbursemps,
                'markAttendmps' => $markAttendmps,
                'total' => $total,
                'totalcount' => $totalcount,
                'leavescount' => $leavescount,
                'reimburscount' => $reimburscount,
                'markAttendancescount' => $markAttendancescount,
                'empleavecount' => $empleavecount,
                'reimbursempcount' => $reimbursempcount,
                'markAttendmpcount' => $markAttendmpcount
            ]);
        });


        View::composer('layouts.includes.sidebar', function ($view) {
            $employees = EmployeeRecord::where('email', Auth::user()->email)->first('employee_name');

            $view->with([
                'employ' => $employees,

            ]);
        });
    }
}
